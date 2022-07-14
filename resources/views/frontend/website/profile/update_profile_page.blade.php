@extends('frontend.app')

@section('title','Profile')

@push('css')
<style>
    .profile-update {
        margin-top: 25px;
        margin-bottom: 32px !important;
        display: block;
    }
</style>
@endpush

@section('content')
<div class="profile-update container">
    <div class="col-xl-12">
        <div class="d-flex flex-column flex-lg-row mb-2 mb-lg-0">
            <div class="col-lg-6">
                <p class="lead text-center">
                    Update Bio Information
                </p><br>
                <form action="{{ route('update.bio') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="p-2 form-control @error('name') text-danger @enderror" id="name" aria-describedby="emailHelp" value="{{ old('name', auth()->user()->name) }}">
                        <div id="emailHelp">
                            @error('name')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" name="phone" class="p-2 form-control @error('phone') text-danger @enderror" id="phone" aria-describedby="emailHelp" value="{{ old('phone', auth()->user()->phone) }}">
                        <div id="emailHelp">
                            @error('phone')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3 form-floating">
                        <label for="about" class="form-label">About</label>
                        <textarea class="p-2 form-control @error('about') text-danger @enderror" name="about" id="about" rows="5">
                            {!! old('about', auth()->user()->about) !!}
                        </textarea>
                        <div id="emailHelp">
                            @error('about')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input accept="image/*" class="p-2 form-control @error('image') text-danger @enderror" name="image" type="file" id="image" onchange="readURL(this);">
                        <img src="#" id="one" >
                        <div id="emailHelp">
                            @error('image')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-black rounded">Submit</button>
                    </div>
                </form>
            </div>
            <br>
            <div class="col-lg-6">
                <p class="lead text-center">
                    Update Credential
                </p><br>
                <form action="{{ route('update.credential') }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="p-2 form-control @error('email') text-danger @enderror" id="email" aria-describedby="emailHelp" value="{{ old('email', auth()->user()->email) }}">
                        <div id="emailHelp">
                            @error('email')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Old Password</label>
                        <input type="password" name="old_password" id="old_password" class="p-2 form-control @error('old_password') text-danger @enderror" aria-describedby="emailHelp" >
                        <div id="emailHelp">
                            @error('old_password')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" name="password" id="password" class="p-2 form-control @error('password') text-danger @enderror" aria-describedby="emailHelp">
                        <div id="emailHelp">
                            @error('password')
                                <div class="form-text text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="p-2 form-control" aria-describedby="emailHelp">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-black rounded">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
	function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#one')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]);
      }
   }
</script>
@endpush