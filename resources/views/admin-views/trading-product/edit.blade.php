@extends('layouts.back-end.app')

@section('title', \App\CPU\translate('Trading Product Edit'))

@push('css_or_js')
    <link href="{{asset('public/assets/back-end/css/tags-input.min.css')}}" rel="stylesheet">
    <link href="{{ asset('public/assets/select2/css/select2.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                <img src="{{asset('/public/assets/back-end/img/inhouse-product-list.png')}}" alt="">
                {{\App\CPU\translate('Trading_Products')}} {{\App\CPU\translate('Edit')}}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form class="product-form" action="{{route('admin.trading-product.update',$product->id)}}" method="post"
                      style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};"
                      enctype="multipart/form-data"
                      id="product_form">
                    @csrf

                    <div class="card">
                        <div class="px-4 pt-3">
                            @php($language=\App\Model\BusinessSetting::where('type','pnc_language')->first())
                            @php($language = $language->value ?? null)
                            @php($default_lang = 'en')

                            @php($default_lang = json_decode($language)[0])
                            <ul class="nav nav-tabs w-fit-content mb-4">
                                @foreach(json_decode($language) as $lang)
                                    <li class="nav-item text-capitalize">
                                        <a class="nav-link lang_link {{$lang == $default_lang? 'active':''}}" href="#"
                                           id="{{$lang}}-link">{{\App\CPU\Helpers::get_language_name($lang).'('.strtoupper($lang).')'}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="card-body">
                            @foreach(json_decode($language) as $lang)
                                <?php
                                if (count($product['translations'])) {
                                    $translate = [];
                                    foreach ($product['translations'] as $t) {

                                        if ($t->locale == $lang && $t->key == "name") {
                                            $translate[$lang]['name'] = $t->value;
                                        }
                                        if ($t->locale == $lang && $t->key == "description") {
                                            $translate[$lang]['description'] = $t->value;
                                        }

                                    }
                                }
                                ?>
                                <div class="{{$lang != 'en'? 'd-none':''}} lang_form" id="{{$lang}}-form">
                                    <div class="form-group">
                                        <label class="title-color" for="{{$lang}}_name">{{\App\CPU\translate('name')}}<span class="text-danger">*</span>
                                            ({{strtoupper($lang)}})</label>
                                        <input type="text" {{$lang == 'en'? 'required':''}} name="name"
                                               id="{{$lang}}_name"
                                               value="{{$translate[$lang]['name']??$product['name']}}"
                                               class="form-control" placeholder="{{\App\CPU\translate('New Product')}}" required>
                                    </div>
                                    <input type="hidden" name="lang[]" value="{{$lang}}">
                                    <div class="form-group pt-4">
                                        <label class="title-color">{{\App\CPU\translate('description')}}
                                            ({{strtoupper($lang)}})</label>
                                        <textarea name="description" class="textarea editor-textarea"
                                                  >{!! $translate[$lang]['description']??$product['details'] !!}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4 class="mb-0">{{\App\CPU\translate('General Info')}}</h4>
                        </div>
                        <div class="card-body">
                           <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="name" class="title-color">{{\App\CPU\translate('Category')}}</label>
                                    <select
                                        class="js-example-basic-multiple js-states js-example-responsive form-control"
                                        name="category_id"
                                        id="category_id"
                                        onchange="getRequest('{{url('/')}}/admin/trading-product/get-categories?parent_id='+this.value,'sub-category-select','select')">
                                        <option value="0" selected disabled>---{{\App\CPU\translate('Select')}}---</option>
                                        @foreach($categories as $category)
                                            <option
                                                value="{{$category->id}}" {{ $category->id==$product_category[0]->id ? 'selected' : ''}} >{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                    <div class="col-md-4">
                                        <label for="name" class="title-color">{{\App\CPU\translate('Breed')}}</label>
                                        <select
                                            class="js-example-basic-multiple js-states js-example-responsive form-control"
                                            name="brand_id">
                                            <option value="{{null}}" selected disabled>---{{\App\CPU\translate('Select')}}---</option>
                                            @foreach($br as $b)
                                                <option
                                                    value="{{$b['id']}}" {{ $b->id==$product->brand_id ? 'selected' : ''}} >{{$b['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                               

                                <div class="col-md-4 physical_product_show">
                                    <label for="name" class="title-color">{{ \App\CPU\translate('Unit') }}</label>
                                    <select class="js-example-basic-multiple js-states js-example-responsive form-control" name="unit">
                                        <option value="pc">Pc</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4 class="mb-0">{{\App\CPU\translate('Product price')}}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-end">
                                <div class="col-md-3 form-group">
                                    <label class="title-color">{{\App\CPU\translate('Unit price')}}</label>
                                    <input type="number" min="0" step="0.01"
                                            placeholder="{{\App\CPU\translate('Unit price') }}"
                                            name="unit_price" class="form-control"
                                            value={{\App\CPU\Convert::default($product->unit_price)}} required>
                                </div>
                                
                                <div class="col-md-3 form-group physical_product_show">
                                    <label class="title-color">{{ \App\CPU\translate('shipping_cost') }}(Estimed) </label>
                                    <input type="number" min="0" value="0" step="1"
                                        placeholder="{{ \App\CPU\translate('shipping_cost') }}" name="shipping_cost"
                                        value="{{\App\CPU\Convert::default($product->shipping_cost)}}"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-3 form-group physical_product_show" >
                                    <div>
                                        <label
                                            class="title-color">Is Pregnent ?
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" name="is_pregnent"  value="0" required="required" <?php if($product->is_pregnent == 0){ echo 'checked';} ?>> No<br>
                                        <input type="radio" name="is_pregnent"  value="1" required="required" <?php if($product->is_pregnent == 1){ echo 'checked';} ?>> Yes
                                    </div>
                                </div>
                                
                                <div class="col-md-3 form-group physical_product_show">
                                    <label class="title-color">Milking Perday(ltr.)</label>
                                    <input type="number" min="0" value="0" step="1"
                                        placeholder="{{ \App\CPU\translate('shipping_cost') }}" name="milking_perday"
                                        value="{{$product->milking_per_day }}"
                                        class="form-control" required>
                                </div>
                                
                                <div class="col-md-3 form-group physical_product_show">
                                    <label class="title-color">Lactation Number</label>
                                   <select
                                    class="js-example-basic-multiple js-states js-example-responsive form-control"
                                    name="lactation_number" required>
                                    <option value="{{ null }}" selected disabled>
                                        ---{{ \App\CPU\translate('Select') }}---</option>
                                        <option value="0" <?php if($product->lactation_number == 0){ echo 'checked';} ?>>0</option>
                                        <option value="1" <?php if($product->lactation_number == 1){ echo 'checked';} ?>>1</option>
                                        <option value="2" <?php if($product->lactation_number == 2){ echo 'checked';} ?>>2</option>
                                        <option value="3" <?php if($product->lactation_number == 3){ echo 'checked';} ?>>3</option>
                                        <option value="4" <?php if($product->lactation_number == 4){ echo 'checked';} ?>>4</option>
                                        <option value="5" <?php if($product->lactation_number == 5){ echo 'checked';} ?>>5</option>
                                        <option value="6" <?php if($product->lactation_number == 6){ echo 'checked';} ?>>6</option>
                                        <option value="7" <?php if($product->lactation_number == 7){ echo 'checked';} ?>>7</option>
                                        <option value="8" <?php if($product->lactation_number == 8){ echo 'checked';} ?>>8</option>
                                        <option value="9" <?php if($product->lactation_number == 9){ echo 'checked';} ?>>9</option>
                                        <option value="10" <?php if($product->lactation_number == 10){ echo 'checked';} ?>>10</option>
                                        
                                    </select>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mt-2 rest-part">
                        <div class="card-header">
                            <h4 class="mb-0">Seller Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-end">
                                <div class="col-md-3 form-group">
                                    <label class="title-color">Select Seller/User</label>
                                    <select
                                    class="js-example-basic-multiple js-states js-example-responsive form-control"
                                    onchange="getRequest('{{ url('/') }}/admin/product/get-user-address?user_id='+this.value,'seller_address','select')"
                                    name="seller_id" required>
                                    <option value="{{ null }}" selected disabled>
                                        ---{{ \App\CPU\translate('Select') }}---</option>
                                        <?php $users =  DB::table('users')->get(); ?>
                                    @foreach ($users as $b)
                                        <option value="{{ $b->id }}" <?php if($b->id == $product->seller_id ){ echo 'selected'; } ?>>{{ $b->f_name }} {{ $b->l_name }} -({{ $b->phone }})</option>
                                    @endforeach
                                </select>
                                    
                                </div>
                                
                                <div class="col-md-3 form-group physical_product_show">
                                    <label class="title-color">Select Seller Address</label>
                                    <select
                                    class="js-example-basic-multiple js-states js-example-responsive form-control"
                                    onchange="getRequestPhone('{{ url('/') }}/admin/product/get-user-location-phone?address_id='+this.value,'sller_contact','select')"
                                    name="seller_address" id="seller_address" required>
                                        <?php $address =  DB::table('shipping_addresses')->where('customer_id',$product->seller_id)->get(); ?>
                                    <option value="{{ null }}" selected disabled>
                                        ---{{ \App\CPU\translate('Select') }}---</option>
                                        @foreach ($address as $b)
                                        <option value="{{ $b->id }}" <?php if($b->id == $product->seller_address ){ echo 'selected'; } ?>>{{ $b->address }} {{ $b->city }} ({{ $b->zip }})</option>
                                        @endforeach
                                       
                                </select>
                                    
                                </div>
                                <div class="col-md-3 form-group physical_product_show" >
                                    <div>
                                        <label
                                            class="title-color">Contact Number
                                        </label>
                                    </div>
                                    <div>
                                        <input type="text" class="form-control" name="sller_contact"  id="sller_contact"  value="{{$product->seller_contact_no}}" required="required">
                                    </div>
                                </div>
                                <div class="col-md-3 form-group physical_product_show" >
                                    <label class="title-color">Location</label>
                                    <select
                                    class="js-example-basic-multiple js-states js-example-responsive form-control"
                                    name="location" required>
                                    <option value="{{ null }}" selected disabled>
                                        ---{{ \App\CPU\translate('Select') }}---</option>
                                      <?php  
                                            $citynn = DB::table('cities')->where('country_code','IN')->orderBy('state_id', 'asc')->get();
                                        ?>
                                        @foreach ($citynn as $cityy)
                                            <?php 
                                                $statename = DB::table('states')->where('id',$cityy->state_id)->first();
                                            ?>
                                                <option value="{{ $cityy->id }}" <?php if($cityy->id == $product->location ){ echo 'selected'; } ?>>{{ $cityy->name }}, {{$statename->name}}</option>
                                        @endforeach
                                    </select> 
                                </div>
                               
                                <div class="col-md-3 form-group physical_product_show">
                                    <label class="title-color">Status</label>
                                    <select
                                    class="js-example-basic-multiple js-states js-example-responsive form-control"
                                    name="product_status" required>
                                    <option value="{{ null }}" selected disabled>
                                        ---{{ \App\CPU\translate('Select') }}---</option>
                                        <option value="1" <?php if($product->status == 1){ echo 'checked';} ?>>Published</option>
                                        <option value="2" <?php if($product->status == 2){ echo 'checked';} ?>>Sold out</option>
                                        <option value="3" <?php if($product->status == 3){ echo 'checked';} ?>>Sent for Verification</option>
                                        <option value="4" <?php if($product->status == 4){ echo 'checked';} ?>>Drop from Web</option>
                                    </select>   
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="card mt-2 rest-part">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <div class="mb-2">
                                        <label class="title-color mb-0">{{\App\CPU\translate('Youtube video link')}}</label>
                                        <span class="text-info"> ( {{\App\CPU\translate('optional, please provide embed link not direct link')}}. )</span>
                                    </div>
                                    <input type="text" value="{{$product['video_url']}}" name="video_link"
                                           placeholder="{{\App\CPU\translate('EX')}} : https://www.youtube.com/embed/5R06LRdUCSE"
                                           class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="title-color">{{\App\CPU\translate('Upload product images')}}</label>
                                        <span class="text-info"><span class="text-danger">*</span> ( {{\App\CPU\translate('ratio')}} 1:1 )</span>
                                    </div>
                                    <div class="p-2 border border-dashed">
                                        <div class="row gy-3" id="coba">
                                            @foreach (json_decode($product->images) as $key => $photo)
                                                <div class="col-sm-6">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <img class="w-100" height="auto"
                                                                 onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                                 src="{{asset("storage/app/public/trading-product/$photo")}}"
                                                                 alt="Product image">
                                                            <a href="{{route('admin.trading-product.remove-image',['id'=>$product['id'],'name'=>$photo])}}"
                                                               class="btn btn-danger btn-block">{{\App\CPU\translate('Remove')}}</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label for="name" class="title-color">{{\App\CPU\translate('Upload thumbnail')}}</label>
                                        <span class="text-info"><span class="text-danger">*</span> ( {{\App\CPU\translate('ratio')}} 1:1 )</span>
                                    </div>

                                    <div class="row gy-3" id="thumbnail">
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <img class="w-100" height="auto"
                                                         onerror="this.src='{{asset('public/assets/front-end/img/image-place-holder.png')}}'"
                                                         src="{{asset("storage/app/public/trading-product/thumbnail")}}/{{$product['thumbnail']}}"
                                                         alt="Product image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end pt-3">
                                @if($product->request_status == 2)
                                    <button type="button" onclick="check()" class="btn btn--primary">{{\App\CPU\translate('Update & Publish')}}</button>
                                @else
                                    <button type="button" onclick="check()" class="btn btn--primary">{{\App\CPU\translate('Update')}}</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script src="{{asset('public/assets/back-end')}}/js/tags-input.min.js"></script>
    <script src="{{asset('public/assets/back-end/js/spartan-multi-image-picker.js')}}"></script>
    <script>
        var imageCount = {{10-count(json_decode($product->images))}};
        var thumbnail = '{{\App\CPU\ProductManager::product_image_path('thumbnail').'/'.$product->thumbnail??asset('public/assets/back-end/img/400x400/img2.jpg')}}';
        $(function () {
            if (imageCount > 0) {
                $("#coba").spartanMultiImagePicker({
                    fieldName: 'images[]',
                    maxCount: imageCount,
                    rowHeight: 'auto',
                    groupClassName: 'col-6',
                    maxFileSize: '',
                    placeholderImage: {
                        image: '{{asset('public/assets/back-end/img/400x400/img2.jpg')}}',
                        width: '100%',
                    },
                    dropFileLabel: "Drop Here",
                    onAddRow: function (index, file) {

                    },
                    onRenderedPreview: function (index) {

                    },
                    onRemoveRow: function (index) {

                    },
                    onExtensionErr: function (index, file) {
                        toastr.error('{{\App\CPU\translate('Please only input png or jpg type file')}}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    },
                    onSizeErr: function (index, file) {
                        toastr.error('{{\App\CPU\translate('File size too big')}}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                });
            }

            $("#thumbnail").spartanMultiImagePicker({
                fieldName: 'image',
                maxCount: 1,
                rowHeight: 'auto',
                groupClassName: 'col-6',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{asset('public/assets/back-end/img/400x400/img2.jpg')}}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('{{\App\CPU\translate('Please only input png or jpg type file')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('{{\App\CPU\translate('File size too big')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

            $("#meta_img").spartanMultiImagePicker({
                fieldName: 'meta_image',
                maxCount: 1,
                rowHeight: 'auto',
                groupClassName: 'col-6',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{asset('public/assets/back-end/img/400x400/img2.jpg')}}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function (index, file) {

                },
                onRenderedPreview: function (index) {

                },
                onRemoveRow: function (index) {

                },
                onExtensionErr: function (index, file) {
                    toastr.error('{{\App\CPU\translate('Please only input png or jpg type file')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function (index, file) {
                    toastr.error('{{\App\CPU\translate('File size too big')}}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>

    <script>
        function getRequest(route, id, type) {
            $.get({
                url: route,
                dataType: 'json',
                success: function (data) {
                    if (type == 'select') {
                        $('#' + id).empty().append(data.select_tag);
                    }
                },
            });
        }
        
        function getRequestPhone(route, id, type) {
            $.get({
                url: route,
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
                    
                        $('#' + id).val(data.select_tag);
                   
                },
            });
            
        }

        $('input[name="colors_active"]').on('change', function () {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors-selector').prop('disabled', true);
            } else {
                $('#colors-selector').prop('disabled', false);
            }
        });

        $('#choice_attributes').on('change', function () {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function () {
                //console.log($(this).val());
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name.split(' ').join('');
            $('#customer_choice_options').append('<div class="row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="' + i + '"><input type="text" class="form-control" name="choice[]" value="' + n + '" placeholder="{{\App\CPU\translate('Choice Title') }}" readonly></div><div class="col-lg-9"><input type="text" class="form-control" name="choice_options_' + i + '[]" placeholder="{{\App\CPU\translate('Enter choice values') }}" data-role="tagsinput" onchange="update_sku()"></div></div>');
            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        setTimeout(function () {
            $('.call-update-sku').on('change', function () {
                update_sku();
            });
        }, 2000)

        $('#colors-selector').on('change', function () {
            update_sku();
        });

        $('input[name="unit_price"]').on('keyup', function () {
            let product_type = $('#product_type').val();
            if(product_type === 'physical') {
                update_sku();
            }
        });

        function update_sku() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: '{{route('admin.trading-product.sku-combination')}}',
                data: $('#product_form').serialize(),
                success: function (data) {
                    $('#sku_combination').html(data.view);
                    update_qty();
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }

        $(document).ready(function () {
            setTimeout(function () {
                let category = $("#category_id").val();
                let sub_category = $("#sub-category-select").attr("data-id");
                let sub_sub_category = $("#sub-sub-category-select").attr("data-id");
                getRequest('{{url('/')}}/admin/product/get-categories?parent_id=' + category + '&sub_category=' + sub_category, 'sub-category-select', 'select');
                getRequest('{{url('/')}}/admin/product/get-categories?parent_id=' + sub_category + '&sub_category=' + sub_sub_category, 'sub-sub-category-select', 'select');
            }, 100)
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state.text;
            }
        });
    </script>

    <script>
        function check() {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }
            var formData = new FormData(document.getElementById('product_form'));
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.trading-product.update',$product->id)}}',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.errors) {
                        for (var i = 0; i < data.errors.length; i++) {
                            toastr.error(data.errors[i].message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                        }
                    } else {
                        toastr.success('product updated successfully!', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                        $('#product_form').submit();
                    }
                }
            });
        };
    </script>

    <script>
        update_qty();

        function update_qty() {
            var total_qty = 0;
            var qty_elements = $('input[name^="qty_"]');
            for (var i = 0; i < qty_elements.length; i++) {
                total_qty += parseInt(qty_elements.eq(i).val());
            }
            if (qty_elements.length > 0) {

                $('input[name="current_stock"]').attr("readonly", true);
                $('input[name="current_stock"]').val(total_qty);
            } else {
                $('input[name="current_stock"]').attr("readonly", false);
            }
        }

        $('input[name^="qty_"]').on('keyup', function () {
            var total_qty = 0;
            var qty_elements = $('input[name^="qty_"]');
            for (var i = 0; i < qty_elements.length; i++) {
                total_qty += parseInt(qty_elements.eq(i).val());
            }
            $('input[name="current_stock"]').val(total_qty);
        });
    </script>

    <script>
        $(".lang_link").click(function (e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#" + lang + "-form").removeClass('d-none');
            if (lang == '{{$default_lang}}') {
                $(".rest-part").removeClass('d-none');
            } else {
                $(".rest-part").addClass('d-none');
            }
        })

        $(document).ready(function(){
            product_type();
            digital_product_type();

            $('#product_type').change(function(){
                product_type();
            });

            $('#digital_product_type').change(function(){
                digital_product_type();
            });
        });

        function product_type(){
            let product_type = $('#product_type').val();

            if(product_type === 'physical'){
                $('#digital_product_type_show').hide();
                $('#digital_file_ready_show').hide();
                $('.physical_product_show').show();
                $("#digital_product_type").val($("#digital_product_type option:first").val());
                $("#digital_file_ready").val('');
            }else if(product_type === 'digital'){
                $('#digital_product_type_show').show();
                $('.physical_product_show').hide();

            }
        }

        function digital_product_type(){
            let digital_product_type = $('#digital_product_type').val();
            if (digital_product_type === 'ready_product') {
                $('#digital_file_ready_show').show();
            } else if (digital_product_type === 'ready_after_sell') {
                $('#digital_file_ready_show').hide();
                $("#digital_file_ready").val('');
            }
        }
    </script>

    {{--ck editor--}}
    <script src="{{asset('/')}}vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script src="{{asset('/')}}vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
    <script>
        $('.textarea').ckeditor({
            contentsLangDirection : '{{Session::get('direction')}}',
        });
    </script>
    {{--ck editor--}}
@endpush
