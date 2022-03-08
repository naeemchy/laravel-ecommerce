@extends('backend.app')

@section('title','Brand')

@push('css')
    <style>
        .brand img{
            width: 180px;
            height: 160px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           EDIT NEW BRAND
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.brand.update',$brand->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="brand_name" class="form-control" name="brand_name" value="{{ old('brand_name', $brand->brand_name) }}">
                                    <label for="brand_name" class="form-label">Brand Name</label>
                                </div>
                                <div class=""><br>
                                    <label for="brand_logo" class="form-label">Brand Logo</label>
                                    <input accept="image/*" type="file" name="brand_logo" onchange="readURL(this);" id="brand_logo">
                                </div><br>
                                <div class="image brand">
                                    @if($brand->brand_logo == 'default.png')
                                    @else
                                        <img src="{{ asset('storage/brand/'.$brand->brand_logo)}}" alt="brand_logo">
                                    @endif
                                    <div id="logo" style="display: none">
                                        <img src="#" id="one">
                                    </div>
                                </div>
                            </div>

                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.brand.index') }}">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script type="text/javascript">
	function readURL(input) {
      if (input.files && input.files[0]) {
          document.getElementById("logo").style.display = "block";
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#one')
                  .attr('src', e.target.result)
                  .width(48)
                  .height(48);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endpush