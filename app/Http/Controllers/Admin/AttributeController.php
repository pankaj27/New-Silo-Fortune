<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Attribute;
use Illuminate\Http\Request;
use App\Model\Translation;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class AttributeController extends Controller
{
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];

        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $attributes = Attribute::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('name', 'like', "%{$value}%");
                }
            });
            
            $query_param = ['search' => $request['search']];
        }else{
            $attributes = new Attribute();
        }
        $attributes = $attributes->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.attribute.view',compact('attributes','search'));
    }

    public function store(Request $request)
    {
        $attribute = new Attribute;
        $attribute->name = $request->name[array_search('en', $request->lang)];
        $attribute->save();
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Attribute',
                        'translationable_id' => $attribute->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
            }
        }
        Toastr::success('Attribute added successfully!');
        return back();
    }

    public function edit($id)
    {
        $attribute = Attribute::withoutGlobalScope('translate')->where('id', $id)->first();
        return view('admin-views.attribute.edit', compact('attribute'));
    }

    public function update(Request $request)
    {
        $attribute = Attribute::find($request->id);
        $attribute->name = $request->name[array_search('en', $request->lang)];
        $attribute->save();

        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Attribute',
                        'translationable_id' => $attribute->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
            }
        }
        Toastr::success('Attribute updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $translation = Translation::where('translationable_type','App\Model\Attribute')
                                    ->where('translationable_id',$request->id);
        $translation->delete();
        Attribute::destroy($request->id);
        return response()->json();
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $data = Attribute::orderBy('id', 'desc')->get();
            return response()->json($data);
        }
    }
    
    public function tradingindex(Request $request){
        
         $query_param = [];
        $search = $request['search'];

        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $attributes = DB::table('trading_attributes')->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('name', 'like', "%{$value}%");
                }
            });
            
            $query_param = ['search' => $request['search']];
        }else{
            $attributes =DB::table('trading_attributes')->orderBy('id','DESC')->get();
        }
        $attributes =DB::table('trading_attributes')->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.tradingattribute.view',compact('attributes','search'));
        
        
    }
    
    public function tradingfetch(Request $request){
        
         if ($request->ajax()) {
            $data = DB::table('trading_attributes')->orderBy('id', 'desc')->get();
            return response()->json($data);
        }
        
    }
    
    public function tradingstore(Request $request){
        
        //  $attribute = new Attribute;
        // $attribute->name = $request->name[array_search('en', $request->lang)];
        // $attribute->save();
        
        // $attribute_store = array(
        //     'name' => $request->name[array_search('en', $request->lang)]
        //     );
            
        $attribute_id = DB::table('trading_attributes')->insertGetId(
                ['name' => $request->name[array_search('en', $request->lang)]]
        );
        
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'Trading Attribute',
                        'translationable_id' => $attribute_id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
            }
        }
        Toastr::success('Attribute added successfully!');
        return back();
        
    }
    
    public function tradingedit($id){
        
         $attribute =  DB::table('trading_attributes')->where('id', $id)->first();
        return view('admin-views.tradingattribute.edit', compact('attribute'));
        
    }
    
    public function tradingupdate(Request $request){
        
         $attribute = DB::table('trading_attributes')->find($request->id);
        // $attribute->name = $request->name[array_search('en', $request->lang)];
        // $attribute->save();
        
        $trading_attr = array(
            'name' => $request->name[array_search('en', $request->lang)]
            );
        
        $affected = DB::table('trading_attributes')
              ->where('id', $request->id)
              ->update($trading_attr);

        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'Trading Attribute',
                        'translationable_id' => $attribute->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
            }
        }
        Toastr::success('Attribute updated successfully!');
        return back();
        
    }
    
    public function tradingdelete(Request $request){
        
        $translation = Translation::where('translationable_type','Trading Attribute')
                                    ->where('translationable_id',$request->id);
        $translation->delete();
         DB::table('trading_attributes')->destroy($request->id);
        return response()->json();
    }
    
}
