<?php

namespace App\Http\Controllers\api\v1;

use App\CPU\TradingCategoryManager;
use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\CPU\TradingProductManager;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\TradingProduct;
use App\Model\Review;
use App\Model\ShippingMethod;
use App\Model\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use function App\CPU\translate;

class TradingProductController extends Controller
{
    public function get_latest_products(Request $request)
    {
        $products = TradingProductManager::get_latest_products($request['limit'], $request['offset']);
        $products['products'] = Helpers::product_data_formatting($products['products'], true);
        return response()->json($products, 200);
    }

    public function get_featured_products(Request $request)
    {
        $products = TradingProductManager::get_featured_products($request['limit'], $request['offset']);
        $products['products'] = Helpers::product_data_formatting($products['products'], true);
        return response()->json($products, 200);
    }

    public function get_top_rated_products(Request $request)
    {
        $products = TradingProductManager::get_top_rated_products($request['limit'], $request['offset']);
        $products['products'] = Helpers::product_data_formatting($products['products'], true);
        return response()->json($products, 200);
    }

    public function get_searched_products(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $products = TradingProductManager::search_products($request['name'], $request['limit'], $request['offset']);
        if ($products['products'] == null) {
            $products = TradingProductManager::translated_product_search($request['name'], $request['limit'], $request['offset']);
        }
        $products['products'] = Helpers::product_data_formatting($products['products'], true);
        return response()->json($products, 200);
    }

    public function get_product($slug)
    {
        $product = TradingProduct::with(['reviews.customer'])->where(['slug' => $slug])->first();
        if (isset($product)) {
            $product = Helpers::product_data_formatting($product, false);

            if(isset($product->reviews) && !empty($product->reviews)){
                $overallRating = \App\CPU\TradingProductManager::get_overall_rating($product->reviews);
                $product['average_review'] = $overallRating[0];
            }else{
                $product['average_review'] = 0;
            }


        }
        return response()->json($product, 200);
    }

    public function get_best_sellings(Request $request)
    {
        $products = TradingProductManager::get_best_selling_products($request['limit'], $request['offset']);
        $products['products'] = Helpers::product_data_formatting($products['products'], true);

        return response()->json($products, 200);
    }

    public function get_home_categories()
    {
        $categories = DB::table('trading_categories')->where('home_status', 1)->get();
        $categories->map(function ($data) {
            //$products = TradingProduct::where('category_ids','like',"%".$data->id."%")->where('status','=',1)->get();
            //$data['products'] = Helpers::product_data_formatting($products, true);
            $data['products'] = Helpers::product_data_formatting(TradingCategoryManager::products($data->id), true);
            return $data;
        });
        return response()->json($categories, 200);
    }

    public function get_related_products($id)
    {
        if (TradingProduct::find($id)) {
            $products = TradingProductManager::get_related_products($id);
            $products = Helpers::product_data_formatting($products, true);
            return response()->json($products, 200);
        }
        return response()->json([
            'errors' => ['code' => 'product-001', 'message' => translate('Product not found!')]
        ], 404);
    }

    public function get_product_reviews($id)
    {
        $reviews = Review::with(['customer'])->where(['product_id' => $id])->get();

        $storage = [];
        foreach ($reviews as $item) {
            $item['attachment'] = json_decode($item['attachment']);
            array_push($storage, $item);
        }

        return response()->json($storage, 200);
    }

    public function get_product_rating($id)
    {
        try {
            $product = TradingProduct::find($id);
            $overallRating = \App\CPU\TradingProductManager::get_overall_rating($product->reviews);
            return response()->json(floatval($overallRating[0]), 200);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e], 403);
        }
    }

    public function counter($product_id)
    {
        try {
            $countOrder = OrderDetail::where('product_id', $product_id)->count();
            $countWishlist = Wishlist::where('product_id', $product_id)->count();
            return response()->json(['order_count' => $countOrder, 'wishlist_count' => $countWishlist], 200);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e], 403);
        }
    }

    public function social_share_link($product_slug)
    {
        $product = TradingProduct::where('slug', $product_slug)->first();
        $link = route('product', $product->slug);
        try {

            return response()->json($link, 200);
        } catch (\Exception $e) {
            return response()->json(['errors' => $e], 403);
        }
    }

    public function submit_product_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'comment' => 'required',
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }


        $image_array = [];
        if (!empty($request->file('fileUpload'))) {
            foreach ($request->file('fileUpload') as $image) {
                if ($image != null) {
                    array_push($image_array, ImageManager::upload('review/', 'png', $image));
                }
            }
        }

        Review::updateOrCreate(
            [
                'delivery_man_id'=> null,
                'customer_id'=>$request->user()->id,
                'product_id'=>$request->product_id
            ],
            [
                'customer_id' => $request->user()->id,
                'product_id' => $request->product_id,
                'comment' => $request->comment,
                'rating' => $request->rating,
                'attachment' => json_encode($image_array),
            ]
        );

        return response()->json(['message' => translate('successfully review submitted!')], 200);
    }

    public function submit_deliveryman_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'comment' => 'required',
            'rating' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $order = Order::where([
                'id'=>$request->order_id,
                'customer_id'=>$request->user()->id,
                'payment_status'=>'paid'])->first();

        if(!isset($order->delivery_man_id)){
            return response()->json(['message' => translate('Invalid review!')], 403);
        }

        Review::updateOrCreate(
            [
                'delivery_man_id'=>$order->delivery_man_id,
                'customer_id'=>$request->user()->id,
                'order_id' => $order->id
            ],
            [
                'customer_id' => $request->user()->id,
                'order_id' => $order->id,
                'delivery_man_id' => $order->delivery_man_id,
                'comment' => $request->comment,
                'rating' => $request->rating,
            ]
        );

        return response()->json(['message' => translate('successfully review submitted!')], 200);
    }

    public function get_shipping_methods(Request $request)
    {
        $methods = ShippingMethod::where(['status' => 1])->get();
        return response()->json($methods, 200);
    }

    public function get_discounted_product(Request $request)
    {
        $products = TradingProductManager::get_discounted_product($request['limit'], $request['offset']);
        $products['products'] = Helpers::product_data_formatting($products['products'], true);
        return response()->json($products, 200);
    }
}
