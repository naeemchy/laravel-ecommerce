@extends('backend.app')

@section('title','Product Stock Update')

@push('css')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/css/tagsinput.css') }}" rel="stylesheet" />
    <style>
        .check .card{
            padding: 10px;
        }
    </style>    
@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <form action="{{ route('admin.product.stock.update',$product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               Product Stock Update
                            </h2>
                        </div>
                        <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" id="product_quantity" class="form-control" name="product_quantity" value="{{ old('product_quantity', $product->product_quantity) }}">
                                    <label class="form-label">Product Quantity</label>
                                </div>
                                <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.all.product.stock') }}">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js') 

@endpush