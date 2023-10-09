<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Testimonial;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Translation;
use Rap2hpoutre\FastExcel\FastExcel;
//use Brian2694\Toastr\Facades\Toastr;

class TestimonialController extends Controller
{
    
    public function add_new()
    {
        $br = Testimonial::latest()->paginate(Helpers::pagination_limit());
        $language=\App\Model\BusinessSetting::where('type','pnc_language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';

        return view('admin-views.testimonial.add-new', compact('br', 'language', 'default_lang'));
    }
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];

        if ($request->has('search'))
        {
            $key = explode(' ', $request['search']);
            $testimonial = Testimonial::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->Where('name', 'like', "%{$value}%");
                }
            });
            
            $query_param = ['search' => $request['search']];
        }else{
            $testimonial = new Testimonial();
        }
        $testimonial = $testimonial->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('admin-views.testimonial.list',compact('testimonial','search'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name.0' => 'required',
            'designation'=> 'required',
            'description' => 'required',
            
        ], [
            'name.0.required'   => 'User name is required!',
            'designation.required'   => 'Desigation is required!',
            'description.required'   => 'Description is required!',
            
        ]);

        $testimonial = new Testimonial;
        $testimonial->name = $request->name[array_search('en', $request->lang)];
        $testimonial->designation = $request->designation;
        $testimonial->description = $request->description;
        $testimonial->image = ImageManager::upload('testimonial/', 'png', $request->file('image'));
        $testimonial->status = 1;
        $testimonial->save();

        foreach($request->lang as $index=>$key)
        {
            if($request->name[$index] && $key != 'en')
            {
                Translation::updateOrInsert(
                    ['translationable_type'  => 'App\Model\Testimonial',
                        'translationable_id'    => $brand->id,
                        'locale'                => $key,
                        'key'                   => 'name'],
                    ['value'                 => $request->name[$index]]
                );
            }
        }
        Toastr::success('Testimonial added successfully!');
        return back();
    }

    public function edit($id)
    {
        $b = Testimonial::where(['id' => $id])->withoutGlobalScopes()->first();
        return view('admin-views.testimonial.edit', compact('b'));
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name.0' => 'required',
            'designation'=> 'required',
            'description' => 'required',
            
        ], [
            'name.0.required'   => 'User name is required!',
            'designation.required'   => 'Desigation is required!',
            'description.required'   => 'Description is required!',
            
        ]);

        $testimonial = Testimonial::find($id);
        $testimonial->name = $request->name[array_search('en', $request->lang)];
        $testimonial->designation = $request->designation;
        $testimonial->description = $request->description;
        
        if ($request->has('image')) {
            $testimonial->image = ImageManager::update('testimonial/', $testimonial['image'], 'png', $request->file('image'));
         }
        $testimonial->save();
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Testimonial',
                        'translationable_id' => $testimonial->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
            }
        }

        Toastr::success('Testimonial updated successfully!');
        return back();
    }

    public function delete(Request $request)
    {
        $translation = Translation::where('translationable_type','App\Model\Testimonial')
                                    ->where('translationable_id',$request->id);
        $translation->delete();
        $testimonial = Testimonial::find($request->id);
        ImageManager::delete('/testimonial/' . $testimonial['image']);
        $testimonial->delete();
        return response()->json();
    }
    
    public function status_update(Request $request)
    {
        $testimonial = Testimonial::find($request['id']);
        $testimonial->status = $request['status'];

        if($testimonial->save()){
            $success = 1;
        }else{
            $success = 0;
        }
        return response()->json([
            'success' => $success,
        ], 200);
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $data = Attribute::orderBy('id', 'desc')->get();
            return response()->json($data);
        }
    }
    
}