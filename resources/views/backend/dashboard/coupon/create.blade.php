@extends('backend.app')

@section('title','Coupon')

@push('css')

@endpush

@section('content')
    <div class="container-fluid">
        <!-- Vertical Layout | With Floating Label -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           Add New Coupon
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.coupon.store') }}" method="POST">
                            @csrf
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="coupon" class="form-control" name="coupon" value="{{ old('coupon', '') }}">
                                    <label for="coupon" class="form-label">Coupon Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" id="discount" class="form-control" name="discount" value="{{ old('discount', '') }}">
                                    <label for="discount" class="form-label">Discount Ammount</label>
                                </div>
                            </div>

                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.coupon.index') }}">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush