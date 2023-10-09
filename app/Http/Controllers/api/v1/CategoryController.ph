<?php

namespace App\Http\Controllers\api\v1;

use App\CPU\CategoryManager;
//use App\CPU\TradingCategoryManager;
//use App\CPU\TradingCategoryManager;
use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Breed;
use App\Model\TradingCategory;
use App\Model\TradingProduct;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function get_categories()
    {
        try {
            $categories = Category::with(['childes.childes'])->where(['position' => 0])->priority()->get();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_products($id)
    {
        return response()->json(Helpers::product_data_formatting(CategoryManager::products($id), true), 200);
    }
    
    
    public function get_trading_categories()
    {
        try {
            $categories = TradingCategory::with(['childes.childes'])->where(['position' => 0])->priority()->get();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
    }

    public function get_trading_products($id)
    {
        
      // return response()->json(Helpers::product_data_formatting(CategoryManager::products($id), true), 200);
      return response()->json([], 200);
       
       
        
    }
    
    
    public function get_trading_breed(){
        
        try {
            $categories = Breed::where('status','=',1)->get();
            return response()->json($categories, 200);
        } catch (\Exception $e) {
            return response()->json([], 200);
        }
        
    }
    
    public function get_breed_products($id){
        
        $products = TradingProduct::where('brand_id','=',$id)->where('status','=',1)->get();
        return response()->json(Helpers::product_data_formatting($products, true), 200);
        
    }
    
    
    
    
    
}
