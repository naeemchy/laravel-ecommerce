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
                          Edit Coupon
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.coupon.update',$coupon->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="coupon" class="form-control" name="coupon" value="{{ old('coupon', $coupon->coupon) }}">
                                    <label for="coupon" class="form-label">Coupon Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="discount" class="form-control" name="discount" value="{{ old('discount', $coupon->discount) }}">
                                    <label for="discount" class="form-label">Discount</label>
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