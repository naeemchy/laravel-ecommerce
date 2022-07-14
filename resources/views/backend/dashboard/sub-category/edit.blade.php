@extends('backend.app')

@section('title','Sub-Category')

@push('css')
<link href="{{ asset('backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
<style>
    select:focus{
        outline: none;
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
                           EDIT NEW SUB-CATEGORY
                        </h2>
                    </div>
                    <div class="body">
                        <form action="{{ route('admin.sub-category.update',$subcategory->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <p>
                                        <b>Category</b>
                                    </p>
                                    <select class="form-control show-tick" name="category_id">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="subcategory_name" class="form-control" name="subcategory_name" value="{{ old('subcategory_name', $subcategory->subcategory_name) }}">
                                    <label for="subcategory_name" class="form-label">Sub-Category Name</label>
                                </div>
                            </div>

                            <a  class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.sub-category.index') }}">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script src="{{ asset('backend/js/pages/forms/advanced-form-elements.js') }}"></script>
@endpush