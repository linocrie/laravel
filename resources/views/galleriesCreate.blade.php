@extends('layouts.app')

@section('content')
    <div class="container">
        <form method="POST" action="{{ route('galleries.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right font-weight-bold text-light">{{ __('Title') }}</label>
                <div class="col-md-6">
                    <input id="title" type="text"
                           class="form-control @error('title') is-invalid @enderror" name="title"
                           required autofocus>
                </div>
            </div>

            <div class="form-group d-flex">
                <label for="gallery_images"
                       class="col-md-4 col-form-label text-md-right font-weight-bold text-light">{{ __('Image') }}</label>
                <div class="col-md-6">
                    <input type="file" name="gallery_images[]" multiple class="w-100 custom-file-input @error('avatar') is-invalid @enderror"
                           id="gallery_images">
                    @error('avatar')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                   </span>
                    @enderror
                    <label class="custom-file-label" for="myAvatar">Choose file</label>
                </div>
            </div>
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-light text-danger font-weight-bold">Create</button>
            </div>
        </form>
    </div>
@endsection
