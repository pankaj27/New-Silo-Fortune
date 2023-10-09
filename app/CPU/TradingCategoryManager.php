<?php

namespace App\CPU;

use App\Model\TradingCategory;
use App\Model\TradingProduct;

class TradingCategoryManager
{
    public static function parents()
    {
        $x = TradingCategory::with(['childes.childes'])->where('position', 0)->priority()->get();
        return $x;
    }

    public static function child($parent_id)
    {
        $x = TradingCategory::where(['parent_id' => $parent_id])->get();
        return $x;
    }

    public static function products($category_id)
    {
        $id = '"'.$category_id.'"';
        return TradingProduct::active()
            ->where('category_ids', 'like', "%{$id}%")->get();
            /*->whereJsonContains('category_ids', ["id" => (string)$data['id']])*/
    }
}
