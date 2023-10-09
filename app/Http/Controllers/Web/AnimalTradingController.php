<?php

namespace App\Http\Controllers\Web;

//use App\Http\Controllers\Controller;
use App\CPU\Helpers;
use App\CPU\OrderManager;
use App\CPU\ProductManager;
use App\CPU\CartManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Brand;
use App\Model\BusinessSetting;
use App\Model\Cart;
use App\Model\CartShipping;
use App\Model\Category;
use App\Model\Contact;
use App\Model\DealOfTheDay;
use App\Model\DeliveryCountryCode;
use App\Model\DeliveryZipCode;
use App\Model\FlashDeal;
use App\Model\FlashDealProduct;
use App\Model\HelpTopic;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\Review;
use App\Model\Seller;
use App\Model\Subscription;
use App\Model\ShippingMethod;
use App\Model\Shop;
use App\Model\Order;
use App\Model\Transaction;
use App\Model\Translation;
use App\Traits\CommonTrait;
use App\User;
use App\Model\Wishlist;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use function App\CPU\translate;
use App\Model\ShippingType;
use Facade\FlareClient\Http\Response;
use Gregwar\Captcha\PhraseBuilder;
use Gregwar\Captcha\CaptchaBuilder;
use App\CPU\CustomerManager;
use App\CPU\Convert;

class AnimalTradingController extends Controller
{
    public function index()
    {
       
        if(auth('customer')->check()){
            
            $featured_items = DB::table('trading_products')->where('status', 1)->where('featured_status',1)->where('seller_id', '!=', auth('customer')->id())->get();
            $latest_product = DB::table('trading_products')->where('status', 1)->where('seller_id', '!=', auth('customer')->id())->get();
            
        }else{
           
           $featured_items = DB::table('trading_products')->where('status', 1)->where('featured_status',1)->get(); 
           $latest_product = DB::table('trading_products')->where('status', 1)->get();
            
        }
        
        
        
        
        return view('web-views.animal-trading.home', compact('featured_items','latest_product'));
        
    }
    
    public function searchByCategory(Request $request){
        
        
        return view('web-views.animal-trading.search_by_category');
        
    }
    
     public function vieAllCategory(){
        
        
        return view('web-views.animal-trading.view_all_category');
        
    }
    
    
    
    public function detailsItemDescroption(Request $request, $slug){
        
        $details_view = DB::table('trading_products')->where('slug',$slug)->where('status',1)->get();
        
        return view('web-views.animal-trading.details_item_view', compact('details_view'));
        
    }
    
    
    public function viewAllAds(Request $request){
        
        if(auth('customer')->check()){
            
            $latest_product = DB::table('trading_products')->where('status', 1)->where('seller_id', '!=', auth('customer')->id())->get();
            
        }else{
           
           $latest_product = DB::table('trading_products')->where('status', 1)->get();
            
        }
        
        
        
        
        return view('web-views.animal-trading.view_all_add', compact('latest_product'));
        
    }
    
    
    public function searchByLocation(Request $request, $id){
        
        if(auth('customer')->check()){
            
            $search_by_location = DB::table('trading_products')->where('status', 1)->where('location',$id)->where('seller_id', '!=', auth('customer')->id())->get();
            
        }else{
           
           $search_by_location = DB::table('trading_products')->where('status', 1)->where('location',$id)->get();
            
        }
        
        $location_id = $id;
        
        
        return view('web-views.animal-trading.search_by_location', compact('search_by_location','location_id'));
        
    }
    
    public function searchByAllLocation(Request $request){
        
        if(auth('customer')->check()){
            
            $search_by_location = DB::table('trading_products')->where('status', 1)->where('seller_id', '!=', auth('customer')->id())->get();
            
        }else{
           
           $search_by_location = DB::table('trading_products')->where('status', 1)->get();
            
        }
        
       $location_id = '';
        
        
        return view('web-views.animal-trading.search_by_location', compact('search_by_location','location_id'));
        
    }
    
    
    public function addProduct(Request $request){
        
        //if(auth('customer')->check()){
            
            
            //Toastr::error('Please Login or Signup to upload your First Product');
            //return back()->withInput();
        
            
        //}
        
        $category = DB::table('trading_categories')->get();
        $breed = DB::table('breeds')->where('status',1)->get();
        
        
        return view('web-views.animal-trading.add_product' , compact('category','breed'));
        
    }
    
    public function myListing(Request $request){
        
        
        
        return view('web-views.animal-trading.my_listing');
        
    }
    
    
    
    
}
