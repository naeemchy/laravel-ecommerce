@extends('backend.app')

@section('title','Product')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/tagsinput.css') }}" rel="stylesheet" />
    <style>
        .check .card{
            padding: 10px;
        }

        .product img{
            width: 180px;
            height: 160px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.product.update',$product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               EDIT NEW PRODUCT
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="product_name" class="form-control" name="product_name" value="{{ old('product_name', $product->product_name) }}">
                                    <label class="form-label">Product Name</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="product_code" class="form-control" name="product_code" value="{{ old('product_code', $product->product_code) }}">
                                    <label class="form-label">Product Code</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" id="product_quantity" class="form-control" name="product_quantity" value="{{ old('product_quantity', $product->product_quantity) }}">
                                    <label class="form-label">Product Quantity</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="selling_price" class="form-control" name="selling_price" value="{{ old('selling_price', $product->selling_price) }}">
                                    <label class="form-label">Product Selling Price</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="discount_price" class="form-control" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}">
                                    <label class="form-label">Product Discount Price</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="video_link" class="form-control" name="video_link" value="{{ old('video_link', $product->video_link) }}">
                                    <label class="form-label">Review video link</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Product Color & Size
                            </h2>
                        </div>
                        <div class="body">

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="product_color" class="form-control" name="product_color" value="{{ old('product_color',  $product->product_color) }}" data-role="tagsinput">
                                    <label class="form-label" for="product_color">Color</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="product_size" class="form-control" name="product_size" value="{{ old('product_size', $product->product_size) }}" data-role="tagsinput">
                                    <label for="product_size" class="form-label">Size</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="demo-switch check">
                <div class="row clearfix">
                    <div class="col-sm-3 card">
                        <div class="demo-switch-title">Main Slider</div>
                        <div class="switch">
                            <label><input type="checkbox" name="main_slider" value="{{ old('main_slider', 1) }}" {{ $product->main_slider == 1 ? 'checked' : '' }}><span class="lever switch-col-deep-purple"></span></label>
                        </div>
                    </div>
                    <div class="col-sm-3 card">
                        <div class="demo-switch-title">Mid Slider</div>
                        <div class="switch">
                            <label><input type="checkbox" name="mid_slider" value="{{ old('mid_slider', 1) }}" {{ $product->mid_slider == 1 ? 'checked' : '' }}><span class="lever switch-col-deep-purple"></span></label>
                        </div>
                    </div>
                    <div class="col-sm-3 card">
                        <div class="demo-switch-title">Hot Deal</div>
                        <div class="switch">
                            <label><input type="checkbox" name="hot_deal" value="{{ old('hot_deal', 1) }}" {{ $product->hot_deal == 1 ? 'checked' : '' }}><span class="lever switch-col-deep-purple"></span></label>
                        </div>
                    </div>
                    <div class="col-sm-3 card">
                        <div class="demo-switch-title">Best Rated</div>
                        <div class="switch">
                            <label><input type="checkbox" name="best_rated" value="{{ old('best_rated', 1) }}" {{ $product->best_rated == 1 ? 'checked' : '' }}><span class="lever switch-col-deep-purple"></span></label>
                        </div>
                    </div>
                    <div class="col-sm-3 card">
                        <div class="demo-switch-title">Hot New</div>
                        <div class="switch">
                            <label><input type="checkbox" name="hot_new" value="{{ old('hot_new', 1) }}" {{ $product->hot_new == 1 ? 'checked' : '' }}><span class="lever switch-col-deep-purple"></span></label>
                        </div>
                    </div>
                    <div class="col-sm-3 card">
                        <div class="demo-switch-title">Trend</div>
                        <div class="switch">
                            <label><input type="checkbox" name="trend" value="{{ old('trend', 1) }}" {{ $product->trend == 1 ? 'checked' : '' }}><span class="lever switch-col-deep-purple"></span></label>
                        </div>
                    </div>    
                    <div class="col-sm-3 card">
                        <div class="demo-switch-title">Buyone Getone</div>
                        <div class="switch">
                            <label><input type="checkbox" name="buyone_getone" value="{{ old('buyone_getone', 1) }}" {{ $product->buyone_getone == 1 ? 'checked' : '' }}><span class="lever switch-col-deep-purple"></span></label>
                        </div>
                    </div>                
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               EDIT IMAGE
                            </h2>
                        </div>
                        <div class="body">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-8">
                                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="image_one">Featured Image One</label>
                                        <input type="file" name="image_one" onchange="readURL1(this);"  accept="image">
                                        <div id="image_one" style="display: none">
                                            <img src="#" id="one">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-4">
                                    <div class="image product">
                                        @if($product->image_one == 'default.png')
                                        @else
                                            <img src="{{ asset('storage/product/'.$product->image_one)}}" alt="image_one">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-8">
                                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                     <div class="form-group">
                                        <label for="image_two">Featured Image Two</label>
                                        <input type="file" name="image_two" onchange="readURL2(this);"  accept="image">
                                        <div id="image_two" style="display: none">
                                            <img src="#" id="two">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-4">
                                    <div class="image product">
                                        @if($product->image_two == 'default.png')
                                        @else
                                            <img src="{{ asset('storage/product/'.$product->image_two)}}" alt="image_two">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-8">
                                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="image_three">Featured Image Three</label>
                                        <input type="file" name="image_three" onchange="readURL3(this);"  accept="image">
                                        <div id="image_three" style="display: none">
                                            <img src="#" id="three">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-4">
                                    <div class="image product">
                                        @if($product->image_three == 'default.png')
                                        @else
                                            <img src="{{ asset('storage/product/'.$product->image_three)}}" alt="image_three">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="today" value="{{ date('d-m-y') }}">

                            <div class="form-group">
                                <input type="checkbox" id="publish" class="filled-in" name="status" value="1" {{ $product->status == 1 ? 'checked' : '' }}>
                                <label for="publish">Publish</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Categories, Sub-Category and Brand
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                <select class="form-control select2" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mg-b-10-force">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Sub Category: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" name="sub_category_id">
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ $subcategory->id == $product->sub_category_id ? 'selected' : '' }}>{{ $subcategory->subcategory_name }}</option>
                                        @endforeach                                        
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mg-b-10-force">
                                <div class="form-line {{ $errors->has('brand_id') ? 'focused error' : '' }}">
                                    <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                                    <select class="form-control show-tick" name="brand_id">
                                        @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                        @endforeach 
                                    </select>
                                </div>
                            </div>

                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.product.index') }}">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Product Description
                            </h2>
                        </div>
                        <div class="body">
                            <textarea id="tinymce" name="product_details">
                                {!! $product->product_details !!}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js') 
    <!-- Select Plugin Js -->
    <script src="{{ asset('backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('backend/js/tagsinput.js') }}"></script>
    <script src="{{ asset('backend/plugins/tinymce/tinymce.js') }}"></script>
    {{-- 
    <script type="text/javascript">
	  $(document).ready(function() {
         $('select[name="category_id"]').on('change', function(){
             var category_id = $(this).val();
             if(category_id) {
                 $.ajax({
                     url: "{{  url('/get/subcategory/') }}/"+category_id, 
                     type:"GET",
                     dataType:"json",
                     success:function(data) {
                        var d =$('select[name="sub_category_id"]').empty();
                           $.each(data, function(key, value){

                               $('select[name="sub_category_id"]').append('<option value="'+ value.id +'">' + value.subcategory_name + '</option>');

                           });
  
                     },
                    
                 });
             } else {
                 alert('danger');
             }

         });
     });
    </script> --}}
    <script>  
        $(function () {
            //TinyMCE
            tinymce.init({
                selector: "textarea#tinymce",
                theme: "modern",
                height: 300,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality',
                    'emoticons template paste textcolor colorpicker textpattern imagetools'
                ],
                toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
                toolbar2: 'print preview media | forecolor backcolor emoticons',
                image_advtab: true
            });
            tinymce.suffix = ".min";
            tinyMCE.baseURL = '{{ asset('backend/plugins/tinymce') }}';
        });
    </script>

    <script type="text/javascript">
        function readURL1(input) {
            if (input.files && input.files[0]) {
                document.getElementById("image_one").style.display = "block";
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(92)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">
        function readURL2(input) {
            if (input.files && input.files[0]) {
                document.getElementById("image_two").style.display = "block";
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#two')
                        .attr('src', e.target.result)
                        .width(92)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script type="text/javascript">
        function readURL3(input) {
            if (input.files && input.files[0]) {
                document.getElementById("image_three").style.display = "block";
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#three')
                        .attr('src', e.target.result)
                        .width(92)
                        .height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endpush