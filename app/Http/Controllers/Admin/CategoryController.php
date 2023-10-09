<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Translation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $categories = Category::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $categories = Category::where(['position' => 0]);
        }

        $categories = $categories->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.category.view', compact('categories','search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'priority'=>'required'
        ], [
            'name.required' => 'Category name is required!',
            'image.required' => 'Category image is required!',
            'priority.required' => 'Category priority is required!',
        ]);

        $category = new Category;
        $category->name = $request->name[array_search('en', $request->lang)];
        $category->slug = Str::slug($request->name[array_search('en', $request->lang)]);
        $category->icon = ImageManager::upload('category/', 'png', $request->file('image'));
        $category->parent_id = 0;
        $category->position = 0;
        $category->priority = $request->priority;
        $category->save();

        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'App\Model\Category',
                    'translationable_id' => $category->id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }
        if (count($data)) {
            Translation::insert($data);
        }

        Toastr::success('Category added successfully!');
        return back();
    }

    public function edit(Request $request, $id)
    {
        $category = category::withoutGlobalScopes()->find($id);
        return view('admin-views.category.category-edit', compact('category'));
    }

    public function update(Request $request)
    {
        $category = Category::find($request->id);
        $category->name = $request->name[array_search('en', $request->lang)];
        $category->slug = Str::slug($request->name[array_search('en', $request->lang)]);
        if ($request->image) {
            $category->icon = ImageManager::update('category/', $category->icon, 'png', $request->file('image'));
        }
        $category->priority = $request->priority;
        $category->save();

        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Category',
                        'translationable_id' => $category->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
            }
        }

        Toastr::success('Category updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $categories = Category::where('parent_id', $request->id)->get();
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $categories1 = Category::where('parent_id', $category->id)->get();
                if (!empty($categories1)) {
                    foreach ($categories1 as $category1) {
                        $translation = Translation::where('translationable_type','App\Model\Category')
                                    ->where('translationable_id',$category1->id);
                        $translation->delete();
                        Category::destroy($category1->id);

                    }
                }
                $translation = Translation::where('translationable_type','App\Model\Category')
                                    ->where('translationable_id',$category->id);
                $translation->delete();
                Category::destroy($category->id);

            }
        }
        $translation = Translation::where('translationable_type','App\Model\Category')
                                    ->where('translationable_id',$request->id);
        $translation->delete();
        Category::destroy($request->id);

        return response()->json();
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $data = Category::where('position', 0)->orderBy('id', 'desc')->get();
            return response()->json($data);
        }
    }

    public function status(Request $request)
    {
        $category = Category::find($request->id);
        $category->home_status = $request->home_status;
        $category->save();
        // Toastr::success('Service status updated!');
        // return back();
        return response()->json([
            'success' => 1,
        ], 200);
    }
    
    public function tradingindex(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $categories = DB::table('trading_categories')->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $categories = DB::table('trading_categories')->where(['position' => 0]);
        }

        $categories = $categories->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.tradingcategory.view', compact('categories','search'));
    }
    
    public function tradingfetch(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('trading_categories')->where('position', 0)->orderBy('id', 'desc')->get();
            return response()->json($data);
        }
    }
    
    public function tradingstore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'priority'=>'required'
        ], [
            'name.required' => 'Category name is required!',
            'image.required' => 'Category image is required!',
            'priority.required' => 'Category priority is required!',
        ]);

        // $category = new Category;
        // $category->name = $request->name[array_search('en', $request->lang)];
        // $category->slug = Str::slug($request->name[array_search('en', $request->lang)]);
        // $category->icon = ImageManager::upload('category/', 'png', $request->file('image'));
        // $category->parent_id = 0;
        // $category->position = 0;
        // $category->priority = $request->priority;
        // $category->save();
        
        
        // $trading_category_insert = array(
            
        //         'name'=> $request->name[array_search('en', $request->lang)],
        //         'slug' => Str::slug($request->name[array_search('en', $request->lang)]),
        //         'icon' => ImageManager::upload('trading_category/', 'png', $request->file('image')),
        //         'parent_id' =>0 ,
        //         'position' =>0,
        //         'priority' =>$request->priority,
                
        //     );
            
            $trading_category_id = DB::table('trading_categories')->insertGetId(
                ['name'=> $request->name[array_search('en', $request->lang)],
                'slug' => Str::slug($request->name[array_search('en', $request->lang)]),
                'icon' => ImageManager::upload('trading_category/', 'png', $request->file('image')),
                'parent_id' =>0 ,
                'position' =>0,
                'priority' =>$request->priority]
        );
        
        

        $data = [];
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                array_push($data, array(
                    'translationable_type' => 'Trading Category',
                    'translationable_id' => $trading_category_id,
                    'locale' => $key,
                    'key' => 'name',
                    'value' => $request->name[$index],
                ));
            }
        }
        if (count($data)) {
            Translation::insert($data);
        }

        Toastr::success('Trading Category added successfully!');
        return back();
    }
    public function tradingedit(Request $request, $id)
    {
            $category =DB::table('trading_categories')->find($id);
            //$category = $category->toArray();
            return view('admin-views.tradingcategory.category-edit', compact('category'));
    }
    
    public function tradingupdate(Request $request)
    {
        $category = DB::table('trading_categories')->find($request->id);
        // $category->name = $request->name[array_search('en', $request->lang)];
        // $category->slug = Str::slug($request->name[array_search('en', $request->lang)]);
        // if ($request->image) {
        //     $category->icon = ImageManager::update('trading_category/', $category->icon, 'png', $request->file('image'));
        // }
        // $category->priority = $request->priority;
        // $category->save();
        
        $data_update = array(
            'name' => $request->name[array_search('en', $request->lang)],
            'slug'=> Str::slug($request->name[array_search('en', $request->lang)]) ,
            'priority'=>$request->priority 
            );
        if ($request->image) {
            $data_update['icon'] = ImageManager::update('trading_category/', $category->icon, 'png', $request->file('image'));
        }
        
        $affected = DB::table('trading_categories')
              ->where('id', $request->id)
              ->update($data_update);
        
        
        
        

        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'Trading Category',
                        'translationable_id' => $category->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
            }
        }

        Toastr::success('Trading Category updated successfully!');
        return back();
    }
    
    public function tradingdelete(Request $request)
        {
            $categories = DB::table('trading_categories')->where('parent_id', $request->id)->get();
            if (!empty($categories)) {
                foreach ($categories as $category) {
                    $categories1 = DB::table('trading_categories')->where('parent_id', $category->id)->get();
                    if (!empty($categories1)) {
                        foreach ($categories1 as $category1) {
                            $translation = Translation::where('translationable_type','Trading Category')
                                        ->where('translationable_id',$category1->id);
                            $translation->delete();
                            DB::table('trading_categories')->destroy($category1->id);
    
                        }
                    }
                    $translation = Translation::where('translationable_type','Trading Category')
                                        ->where('translationable_id',$category->id);
                    $translation->delete();
                    DB::table('trading_categories')->destroy($category->id);
    
                }
            }
            $translation = Translation::where('translationable_type','Trading Category')
                                        ->where('translationable_id',$request->id);
            $translation->delete();
            DB::table('trading_categories')->destroy($request->id);
    
            return response()->json();
        }
        
    public function tradingstatus(Request $request)
    {
        // $category = DB::table('trading_categories')->find($request->id);
        // $category->home_status = $request->home_status;
        // $category->save();
        
        $affected = DB::table('trading_categories')
              ->where('id', $request->id)
              ->update(['home_status' => $request->home_status]);
        
        
        // Toastr::success('Service status updated!');
        // return back();
        
        if($affected){
            
            return response()->json([
                'success' => true,
            ], 200);
            
        }else{
           
           return response()->json([
                'success' => false,
            ], 403); 
            
        }
        
    }
    
    
    
    public function editNew(Request $request, $id)
    {
        $category = category::withoutGlobalScopes()->find($id);
        return view('admin-views.category.category-edit-new', compact('category'));
    }
    
    
    
    
}
