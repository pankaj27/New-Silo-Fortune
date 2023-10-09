<?php

namespace App\Http\Controllers\api\v2\seller;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Breed;

class BrandController extends Controller
{
    public function getBrands()
    {
        try {
            $brands = Brand::all();
        } catch (\Exception $e) {
        }

        return response()->json($brands,200);
    }
    
    public function getBreeds()
    {
        try {
            $breed = Breed::all();
        } catch (\Exception $e) {
        }

        return response()->json($breed,200);
    }
    
    
}
