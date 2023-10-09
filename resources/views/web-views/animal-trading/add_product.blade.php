@extends('web-views.animal-trading.app')

@section('title', 'Add Listing | Silo Fortune')


@section('content')

@php($language = \App\Model\BusinessSetting::where('type', 'pnc_language')->first())
                            @php($language = $language->value ?? null)
                            @php($default_lang = 'en')

                            @php($default_lang = json_decode($language)[0])

<div class="breadcrumb-bar">
    <div class="container">
        <div class="row align-items-center text-center">
            <div class="col-md-12 col-12">
                <h2 class="breadcrumb-title">Add Product (For Animal Trading)</h2>
                    
            </div>
        </div>
    </div>
</div>

<div class="dashboard-content">
   <div class="container">
      <form action="#" method="post" enctype="multipart/form-data">
      <div class="">
         <ul class="dashborad-menus">
            <li>
               <a href="{{route('user-account')}}">
               <i class="feather-grid"></i> <span>Dashboard</span>
               </a>
            </li>
            <li class="active">
               <a href="{{route('add-product')}}">
               <i class="fa-solid fa-user"></i> <span>Add Listing</span>
               </a>
            </li>
            <li>
               <a href="{{route('my-listing')}}">
               <i class="feather-list"></i> <span>My Listing</span>
               </a>
            </li>
            
            <li>
               <a href="{{route('customer.auth.logout')}}">
               <i class="fas fa-light fa-circle-arrow-left"></i> <span>Logout</span>
               </a>
            </li>
         </ul>
      </div>
      <div class="profile-content">
         <div class="messages-form">
            <div class="card">
               <div class="card-header">
                  <h4>Basic information</h4>
               </div>
               <div class="card-body">
                  <div class="form-group">
                     <label class="col-form-label">Listing Title <span>*</span></label>
                     <input type="text" class="form-control pass-input" placeholder="Title">
                  </div>
                  <div class="form-group">
                     <label class="col-form-label">Listing Description <span>*</span></label>
                     <textarea rows="6" class="form-control listingdescription" placeholder="Message"></textarea>
                  </div>
                  <div class="form-group">
                     <label class="col-form-label label-heading">Category </label>
                     <div class="row category-listing">
                        <div class="col-lg-4">
                           <select class="js-example-basic-multiple js-states js-example-responsive form-control" name="category_id"
                                    
                                    required>
                                    <option value="{{ old('category_id') }}" selected disabled>---Select---
                                    </option>
                                    @foreach ($category as $c)
                                        <option value="{{ $c->id }}"
                                            {{ old('name') == $c->id ? 'selected' : '' }}>
                                            {{ $c->name }}
                                        </option>
                                    @endforeach
                          </select>
                        </div>
                        
                        
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-form-label label-heading">Breed </label>
                     <div class="row category-listing">
                        <div class="col-lg-4">
                           <select
                                    class="js-example-basic-multiple js-states js-example-responsive form-control"
                                    name="brand_id" required>
                                    <option value="{{ null }}" selected disabled>
                                        ---{{ \App\CPU\translate('Select') }}---</option>
                                    @foreach ($breed as $b)
                                        <option value="{{ $b->id }}">{{ $b->name }}</option>
                                    @endforeach
                            </select>
                        </div>
                        
                        
                     </div>
                  </div>
                  <!--<div class="form-group formlast-input">
                     <label class="col-form-label label-heading">Tagline</label>
                     <textarea rows="2" class="form-control tagline" placeholder=""></textarea>
                  </div>-->
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <h4>Basic information</h4>
               </div>
               <div class="card-body">
                  <div class="form-group">
                     <label class="col-form-label">Price</label>
                     <input type="text" class="form-control pass-input" placeholder="$$$">
                  </div>
                  <div class="row">
                       <div class="col-md-3 form-group physical_product_show">
                                    <label class="title-color">{{ \App\CPU\translate('shipping_cost') }}(Estimed) </label>
                                    <input type="number" min="0" value="0" step="1"
                                        placeholder="{{ \App\CPU\translate('shipping_cost') }}" name="shipping_cost"
                                        class="form-control" required>
                                </div>
                                <div class="col-md-3 form-group physical_product_show" >
                                    <div>
                                        <label
                                            class="title-color">Is Pregnent ?
                                        </label>
                                    </div>
                                    <div>
                                        <input type="radio" name="is_pregnent"  value="0" required="required"> No
                                        <input type="radio" name="is_pregnent"  value="1" required="required"> Yes
                                    </div>
                                </div>
                                
                                <div class="col-md-3 form-group physical_product_show">
                                    <label class="title-color">Milking Perday(ltr.)</label>
                                    <input type="number" min="0" value="0" step="1"
                                        placeholder="{{ \App\CPU\translate('shipping_cost') }}" name="milking_perday"
                                        class="form-control" required>
                                </div>
                                
                                <div class="col-md-3 form-group physical_product_show">
                                    <label class="title-color">Lactation Number</label>
                                   <select
                                    class="js-example-basic-multiple js-states js-example-responsive form-control"
                                    name="lactation_number" required>
                                    <option value="{{ null }}" selected disabled>
                                        ---{{ \App\CPU\translate('Select') }}---</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        
                                    </select>
                                </div>
                  </div>
                 
                  
               </div>
            </div>
            
            <div class="card">
               <div class="card-header">
                  <h4>Location information</h4>
               </div>
               <div class="card-body">
                  <div class="form-group">
                     <label class="col-form-label">Location</label>
                     <input type="text" class="form-control" placeholder="location">
                  </div>
                  <div class="form-group">
                     <label class="col-form-label">Address</label>
                     <input type="text" class="form-control" placeholder="addressa">
                  </div>
                  
               </div>
            </div>
            <div class="card">
               <div class="card-header">
                  <h4>Contact Information </h4>
               </div>
               <div class="card-body">
                  
                  <div class="form-group formlast-input">
                     <label class="col-form-label">Phone </label>
                     <input type="text" class="form-control pass-input" placeholder="">
                  </div>
               </div>
            </div>
            
            <div class="card media-section">
               <div class="card-header">
                  <h4>Media Information </h4>
               </div>
               <div class="card-body">
                  <div class="row">
                      <div class="col-md-12 mb-4">
                                    <div class="mb-2">
                                        <label class="title-color">{{ \App\CPU\translate('Youtube video link') }}</label>
                                        <span class="text-info"> (
                                            {{ \App\CPU\translate('optional, please provide embed link not direct link') }}.
                                            )</span>
                                    </div>
                                    <input type="text" name="video_link"
                                        placeholder="{{ \App\CPU\translate('EX') }} : https://www.youtube.com/embed/5R06LRdUCSE"
                                        class="form-control" required>
                    </div>
                     <div class="col-lg-6 col-md-6 featured-img1">
                        <h6 class="media-title">Featured Image</h6>
                        <div class="mb-2">
                                        <label class="title-color">{{ \App\CPU\translate('Upload product images') }}</label>
                                        <span class="text-info">* ( {{ \App\CPU\translate('ratio') }} 1:1 )</span>
                                    </div>
                                    <div class="p-2 border border-dashed">
                                        <div class="row" id="coba"></div>
                                    </div>
                     </div>
                     <div class="col-lg-6 col-md-6 featured-img2">
                        <div class="mb-2">
                                        <label for="name" class="title-color text-capitalize">{{ \App\CPU\translate('Upload thumbnail') }}</label>
                                        <span class="text-info">* ( {{ \App\CPU\translate('ratio') }} 1:1 )</span>
                                    </div>
                                    <div>
                                        <div class="row" id="thumbnail"></div>
                        </div>
                     </div>
                  </div>
                  
               </div>
            </div>
            <button class="btn btn-primary" type="submit"> Submit</button>
         </div>
         </form>
      </div>
   </div>
</div>

@endsection
@push('script')
    <script src="{{ asset('public/assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('public/assets/back-end/js/spartan-multi-image-picker.js') }}"></script>
    <script>
        $(function() {
            $("#coba").spartanMultiImagePicker({
                fieldName: 'images[]',
                maxCount: 10,
                rowHeight: 'auto',
                groupClassName: 'col-6',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error(
                    '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

            $("#thumbnail").spartanMultiImagePicker({
                fieldName: 'image',
                maxCount: 1,
                rowHeight: 'auto',
                groupClassName: 'col-12',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error(
                    '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

            $("#meta_img").spartanMultiImagePicker({
                fieldName: 'meta_image',
                maxCount: 1,
                rowHeight: '280px',
                groupClassName: 'col-12',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset('public/assets/back-end/img/400x400/img2.jpg') }}',
                    width: '90%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error(
                    '{{ \App\CPU\translate('Please only input png or jpg type file') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ \App\CPU\translate('File size too big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function() {
            readURL(this);
        });


        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            // dir: "rtl",
            width: 'resolve'
        });
    </script>

    <script>
        function getRequest(route, id, type) {
            $.get({
                url: route,
                dataType: 'json',
                success: function(data) {
                    //console.log(data);
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

        $('input[name="colors_active"]').on('change', function() {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors-selector').prop('disabled', true);
            } else {
                $('#colors-selector').prop('disabled', false);
            }
        });

        $('#choice_attributes').on('change', function() {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function() {
                //console.log($(this).val());
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name.split(' ').join('');
            $('#customer_choice_options').append(
                '<div class="row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="' + i +
                '"><input type="text" class="form-control" name="choice[]" value="' + n +
                '" placeholder="{{ trans('Choice Title') }}" readonly></div><div class="col-lg-9"><input type="text" class="form-control" name="choice_options_' +
                i +
                '[]" placeholder="{{ trans('Enter choice values') }}" data-role="tagsinput" onchange="update_sku()"></div></div>'
                );

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }


        $('#colors-selector').on('change', function() {
            update_sku();
        });

        $('input[name="unit_price"]').on('keyup', function() {
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
                url: '{{ route('admin.trading-product.sku-combination') }}',
                data: $('#product_form').serialize(),
                success: function(data) {
                    $('#sku_combination').html(data.view);
                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }
                }
            });
        }

        $(document).ready(function() {
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function(m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state
                    .text;
            }
        });
    </script>

    <script>
        function check() {
            Swal.fire({
                title: '{{ \App\CPU\translate('Are you sure') }}?',
                text: '{{ \App\CPU\translate('Want to add this product') }}',
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#377dff',
                cancelButtonText: 'No',
                confirmButtonText: 'Yes',
                reverseButtons: true
            }).then((result) => {
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
                    url: '{{ route('admin.trading-product.store') }}',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                         console.log(data);
                         //return false;
                        if (data.errors) {
                            for (var i = 0; i < data.errors.length; i++) {
                                toastr.error(data.errors[i].message, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        } else {
                            toastr.success(
                            '{{ \App\CPU\translate('product added successfully') }}!', {
                                CloseButton: true,
                                ProgressBar: true
                            });
                            $('#product_form').submit();
                        }
                    }
                });
            })
        };
    </script>

    <script>
        $(".lang_link").click(function(e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];
            console.log(lang);
            $("#" + lang + "-form").removeClass('d-none');
            if (lang == '{{ $default_lang }}') {
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
                $('#digital_product_type').val($('#digital_product_type option:first').val());
                $('#digital_file_ready').val('');
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

    {{-- ck editor --}}
    <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/adapters/jquery.js"></script>
    <script>
        $('.textarea').ckeditor({
            contentsLangDirection: '{{ Session::get('direction') }}',
        });
    </script>

    {{-- ck editor --}}
@endpush