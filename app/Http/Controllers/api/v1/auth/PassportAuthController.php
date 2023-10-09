<?php

namespace App\Http\Controllers\api\v1\auth;

use App\CPU\Helpers;
use App\CPU\SMS_module;
use App\Http\Controllers\Controller;
use App\Model\PhoneOrEmailVerification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use function App\CPU\translate;
use Illuminate\Support\Facades\DB;

class PassportAuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:8',
        ], [
            'f_name.required' => 'The first name field is required.',
            'l_name.required' => 'The last name field is required.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }
        $temporary_token = Str::random(40);
        $auth_token = Str::random(50);
        
        //$auth_token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
        
        $user = User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => 1,
            'password' => bcrypt($request->password),
            'temporary_token' => $temporary_token,
            
        ]);

        $phone_verification = Helpers::get_business_settings('phone_verification');
        $email_verification = Helpers::get_business_settings('email_verification');
        if ($phone_verification && !$user->is_phone_verified) {
            return response()->json(['temporary_token' => $temporary_token], 200);
        }
        if ($email_verification && !$user->is_email_verified) {
            return response()->json(['temporary_token' => $temporary_token], 200);
        }
        
        $userid = DB::table('users')->where('email', $request->email)->get();
        
        $token = $user->createToken('LaravelAuthApp')->accessToken;
        
        //update user token 
        DB::table('users')->where('id', $userid[0]->id)->update(['auth_token' => $token]);
        
        
        
        
         //registered as trading shops
        //get user id 
        
        //shop created
        $shop_create = DB::table('trading_shops')->insert([
            'seller_id' => $userid[0]->id,
            'name' => $request->f_name.' '.$request->l_name ,
            'address' => '',
            'contact' => $request->phone,
            'image' => 'def.png',
            'banner' => 'def.png'
        ]);
        
        $seller_create = DB::table('trading_sellers')->insert([
            'id' => $userid[0]->id,
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status'=>'approved',
            'password' => bcrypt($request->password),
            'auth_token' => $token,
        ]);
        
        $seller_wallet_create = DB::table('trading_seller_wallets')->insert([
            'seller_id' => $userid[0]->id,
            'total_earning' => 0,
            'withdrawn' => 0,
            'commission_given' => 0,
            'pending_withdraw'=>0,
            'delivery_charge_earned' => 0,
            'collected_cash' => 0,
            'total_tax_collected'=>0
        ]);
        
        
        
        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $user_id = $request['email'];
        if (filter_var($user_id, FILTER_VALIDATE_EMAIL)) {
            $medium = 'email';
        } else {
            $count = strlen(preg_replace("/[^\d]/", "", $user_id));
            if ($count >= 9 && $count <= 15) {
                $medium = 'phone';
            } else {
                $errors = [];
                array_push($errors, ['code' => 'email', 'message' => 'Invalid email address or phone number']);
                return response()->json([
                    'errors' => $errors
                ], 403);
            }
        }

        $data = [
            $medium => $user_id,
            'password' => $request->password
        ];

        $user = User::where([$medium => $user_id])->first();
        $auth_tokenn = Str::random(50);
        
        

        if (isset($user) && $user->is_active && auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $user->temporary_token = Str::random(40);
            $user->auth_token = $token;
            $user->save();
            
            DB::table('trading_sellers')->where('email', $request['email'])->update(['auth_token' => $token]);

            $phone_verification = Helpers::get_business_settings('phone_verification');
            $email_verification = Helpers::get_business_settings('email_verification');
            if ($phone_verification && !$user->is_phone_verified) {
                return response()->json(['temporary_token' => $user->temporary_token], 200);
            }
            if ($email_verification && !$user->is_email_verified) {
                return response()->json(['temporary_token' => $user->temporary_token], 200);
            }

            
            return response()->json(['token' => $token], 200);
        } else {
            $errors = [];
            array_push($errors, ['code' => 'auth-001', 'message' => translate('Customer_not_found_or_Account_has_been_suspended')]);
            return response()->json([
                'errors' => $errors
            ], 401);
        }
    }
    
    
    public function loginWithMobileNumber(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        

        $user = User::where(['phone' => $request->phone])->first();
        $auth_tokenn = Str::random(50);
        
        $data = [
            'phone' => $request->phone
        ];

        if (isset($user) && $user->is_active) {
            $token = $user->createToken('LaravelAuthApp')->accessToken;
            $user->temporary_token = Str::random(40);
            $user->auth_token = $token;
            $user->save();
            
            DB::table('trading_sellers')->where('phone', $request->phone)->update(['auth_token' => $token]);

            $token = rand(1000, 9999);
            DB::table('phone_or_email_verifications')->insert([
                'phone_or_email' => $request['phone'],
                'token' => $token,
                'created_at' => now()->addMinutes(3),
                'updated_at' => now()->addMinutes(3),
            ]);
            $response = SMS_module::send($request['phone'], $token);
        
            
            return response()->json(['temporary_token' => $user->temporary_token], 200);
            
            //return response()->json(['token' => $token], 200);
        } else {
            
            
            $temporary_token = Str::random(40);
            $auth_token = Str::random(50);
            
            //$auth_token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            $default_pass = "password";
            $user = User::create([
                'f_name' => null,
                'l_name' => null,
                'email' => null,
                'phone' => $request->phone,
                'is_active' => 1,
                'password' => bcrypt($default_pass),
                'temporary_token' => $temporary_token,
                
            ]);
            
            //$phone_verification = Helpers::get_business_settings('phone_verification');
            
            //if ($phone_verification && !$user->is_phone_verified) {
                return response()->json(['temporary_token' => $temporary_token], 200);
            //}
            
            
            $userid = DB::table('users')->where('phone', $request->phone)->get();
            
            $token = $user->createToken('LaravelAuthApp')->accessToken;
            
            //update user token 
            DB::table('users')->where('id', $userid[0]->id)->update(['auth_token' => $token]);
            
            
            $shop_create = DB::table('trading_shops')->insert([
            'seller_id' => $userid[0]->id,
            'name' => null ,
            'address' => '',
            'contact' => $request->phone,
            'image' => 'def.png',
            'banner' => 'def.png'
        ]);
        
        $seller_create = DB::table('trading_sellers')->insert([
            'id' => $userid[0]->id,
            'f_name' => null,
            'l_name' => null,
            'email' => null,
            'phone' => $request->phone,
            'status'=>'approved',
            'password' => bcrypt($default_pass),
            'auth_token' => $token,
        ]);
        
        $seller_wallet_create = DB::table('trading_seller_wallets')->insert([
            'seller_id' => $userid[0]->id,
            'total_earning' => 0,
            'withdrawn' => 0,
            'commission_given' => 0,
            'pending_withdraw'=>0,
            'delivery_charge_earned' => 0,
            'collected_cash' => 0,
            'total_tax_collected'=>0
        ]);
        
        $token = rand(1000, 9999);
        DB::table('phone_or_email_verifications')->insert([
            'phone_or_email' => $request['phone'],
            'token' => $token,
            'created_at' => now()->addMinutes(3),
            'updated_at' => now()->addMinutes(3),
        ]);
        $response = SMS_module::send($request['phone'], $token);
        
        
        
        //return response()->json(['token' => $token], 200);
        
        return response()->json(['temporary_token' => $temporary_token], 200);
            
            
            
            
            
        }
    }
    
    public function otp_verification_submit_for_sign_in_sign_up(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identity' => 'required',
            'otp' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $id = $request['identity'];
        $data = DB::table('password_resets')->where('user_type','customer')->where(['token' => $request['otp']])
            ->where('identity', 'like', "%{$id}%")
            ->first();

        if (isset($data)) {
            return response()->json(['message' => 'otp verified.'], 200);
        }

        return response()->json(['errors' => [
            ['code' => 'not-found', 'message' => 'invalid OTP']
        ]], 404);
    }
    
    public function verify_phone_for_signin_and_signup(Request $request){
        
         $validator = Validator::make($request->all(), [
            'phone' => 'required',
            'temporary_token' => 'required',
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $verify = PhoneOrEmailVerification::where(['phone_or_email' => $request['phone'], 'token' => $request['otp']])->first();

        if (isset($verify)) {
            try {
                
                $user = User::where(['temporary_token' => $request['temporary_token']])->first();
                $user->phone = $request['phone'];
                $user->is_phone_verified = 1;
                $user->save();
                $verify->delete();
                
                $token = $user->createToken('LaravelAuthApp')->accessToken;
                
                DB::table('users')->where('phone', $request->phone)->update(['auth_token' => $token]);
                
                DB::table('trading_sellers')->where('phone', $request->phone)->update(['auth_token' => $token]);
                
                
            } catch (\Exception $exception) {
                return response()->json([
                    'message' => translate('temporary_token_mismatch'),
                ], 200);
            }

            //$token = $user->createToken('LaravelAuthApp')->accessToken;
            return response()->json([
                'message' => translate('otp_verified'),
                'token' => $token
            ], 200);
        }

        return response()->json(['errors' => [
            ['code' => 'token', 'message' => translate('otp_not_found')]
        ]], 404);
    
    }
}
