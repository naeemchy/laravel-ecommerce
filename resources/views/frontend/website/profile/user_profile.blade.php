@extends('frontend.app')

@section('title','Profile')

@push('css')
<style>
    .profile .card {
    margin-top: 36px;
    margin-bottom: 32px !important;
    display: block;
    }

    .profile .image {
        padding: 20px;
        margin: auto;
        width: 200px;
        height: 200px;
        display: block;
    }

    .profile .image > img{
        width: 100%;
        height: 100%;
        border-radius: 50%;
        border: 1px solid green;
        padding: 2px;
    }
</style>
@endpush

@section('content')
<div class="profile">
    <div class="col-xl-8 offset-xl-2">
        <div class="card mb-3 container">
            <div class="row g-0">
                <div class="col-md-3">
                    <div class="image">
                        @if(auth()->user()->image == 'default.png')
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRxXnHpI68YpU-l9X2o_qPTDDITvEx72nfHpw&usqp=CAU" alt="...">
                        @else
                            <img src="{{ asset('storage/profile/'.auth()->user()->image)}}" alt="Profile Image">
                        @endif
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card-body">
                        <h5 class="card-text">{{ auth()->user()->name }}</h5>
                        <p class="card-text pb-2">{{ auth()->user()->email }}</p>
                        <p class="card-text">{{ auth()->user()->about }}</p>
                        <p class="card-text"><small class="text-muted">Last updated at, {{ auth()->user()->updated_at->diffForHumans() }}</small></p><br>
                        <a href="{{ route('update.profile.page') }}" class="btn btn-black text-white rounded">Update</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')

@endpush