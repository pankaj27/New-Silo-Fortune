<?php

namespace App\Http\Controllers\Admin;

use App\CPU\Helpers;
use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\Admin;
use App\Model\Breed;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Translation;
use Rap2hpoutre\FastExcel\FastExcel;

class TradingBreedController extends Controller
{
    public function add_new()
    {
        $br = Breed::latest()->paginate(Helpers::pagination_limit());
        $language=\App\Model\BusinessSetting::where('type','pnc_language')->first();
        $language = $language->value ?? null;
        $default_lang = 'en';

        return view('admin-views.trading-breed.add-new', compact('br', 'language', 'default_lang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name.0' => 'required|unique:brands,name',
        ], [
            'name.0.required'   => 'Breed name is required!',
            'name.0.unique'     => 'The breed has already been taken.',
        ]);

        $brand = new Breed;
        $brand->name = $request->name[array_search('en', $request->lang)];
        $brand->image = ImageManager::upload('trading-breed/', 'png', $request->file('image'));
        $brand->status = 1;
        $brand->save();

        foreach($request->lang as $index=>$key)
        {
            if($request->name[$index] && $key != 'en')
            {
                Translation::updateOrInsert(
                    ['translationable_type'  => 'App\Model\Breed',
                        'translationable_id'    => $brand->id,
                        'locale'                => $key,
                        'key'                   => 'name'],
                    ['value'                 => $request->name[$index]]
                );
            }
        }
        Toastr::success('Breed added successfully!');
        return back();
    }

    /**
     * Brand list show, search
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function list(Request $request)
    {
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        // $br = Breed::withCount('brandAllProducts')
        //     ->with(['brandAllProducts'=> function($query){
        //         $query->withCount('order_details');
        //     }])
        //     ->when($request['search'], function ($q) use($request){
        //         $key = explode(' ', $request['search']);
        //         foreach ($key as $value) {
        //             $q->Where('name', 'like', "%{$value}%")
        //               ->orWhere('id', $value);
        //         }
        //     })
        
          //  $br = Breed::where('status',1)->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
          $br = Breed::where('status',1)->get();

        return view('admin-views.trading-breed.list', compact('br','search'));
    }

    /**
     * Export brand list by excel
     * @return string|\Symfony\Component\HttpFoundation\StreamedResponse
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\InvalidArgumentException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    public function export(){
        $brands = Breed::withCount('brandAllProducts')
            ->with(['brandAllProducts'=> function($query){
                $query->withCount('order_details');
            }])->orderBy('id', 'DESC')->get();

        $data = array();
        foreach($brands as $brand){
            $data[] = array(
                'Brand Name'      => $brand->name,
                'Total Product'   => $brand->brand_all_products_count,
                'Total Order' => $brand->brandAllProducts->sum('order_details_count'),
            );
        }

        return (new FastExcel($data))->download('brand_list.xlsx');
    }

    public function edit($id)
    {
        $b = Breed::where(['id' => $id])->withoutGlobalScopes()->first();
        return view('admin-views.trading-breed.edit', compact('b'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name.0' => 'required|unique:brands,name,'.$id,
        ], [
            'name.0.required'   => 'Brand name is required!',
            'name.0.unique'     => 'The brand has already been taken.',
        ]);

        $brand = Breed::find($id);
        $brand->name = $request->name[array_search('en', $request->lang)];
        if ($request->has('image')) {
            $brand->image = ImageManager::update('brand/', $brand['image'], 'png', $request->file('image'));
         }
        $brand->save();
        foreach ($request->lang as $index => $key) {
            if ($request->name[$index] && $key != 'en') {
                Translation::updateOrInsert(
                    ['translationable_type' => 'App\Model\Brand',
                        'translationable_id' => $brand->id,
                        'locale' => $key,
                        'key' => 'name'],
                    ['value' => $request->name[$index]]
                );
            }
        }

        Toastr::success('Brand updated successfully!');
        return back();
    }

    public function status_update(Request $request)
    {
        $brand = Breed::find($request['id']);
        $brand->status = $request['status'];

        if($brand->save()){
            $success = 1;
        }else{
            $success = 0;
        }
        return response()->json([
            'success' => $success,
        ], 200);
    }

    public function delete(Request $request)
    {
        $translation = Translation::where('translationable_type','App\Model\Brand')
                                    ->where('translationable_id',$request->id);
        $translation->delete();
        $brand = Breed::find($request->id);
        ImageManager::delete('/trading-breed/' . $brand['image']);
        $brand->delete();
        return response()->json();
    }
}
