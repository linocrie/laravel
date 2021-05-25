@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Auth::id() == $gallery->user_id)
            <form method="POST" action="{{ route('galleries.edit',['gallery'=> $gallery->id])}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right text-light font-weight-bold">{{ __('Title') }}</label>
                    <div class="col-md-6">
                        <input id="title" type="text"
                               class="form-control border-dark @error('title') is-invalid @enderror" name="title"
                               required autofocus>
                    </div>
                </div>
                <div class="form-group d-flex">
                    <label for="gallery_images"
                           class="col-md-4 col-form-label text-md-right font-weight-bold text-light">{{ __('Image') }}</label>
                    <div class="col-md-6">
                        <input type="file" name="gallery_images[]" multiple class="w-100 custom-file-input border-dark @error('avatar') is-invalid @enderror"
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
                    <button type="submit" class="btn btn-light text-danger font-weight-bold">Update</button>
                </div>
            </form>
        @endif
        <div class="d-flex flex-wrap">
            @foreach($gallery->galleriesImages as $img)
                <div class="d-flex flex-column text-right">
                    @if(Auth::id() == $gallery->user_id)
                        <form action="{{route('galleries.delete', ['image'=> $img->id])}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <div class="delete">
                                <button class="btn text-danger">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </form>
                    @endif
                    <div class="d-flex justify-content-center align-items-center overflow-hidden mb-3 ml-3"
                         style="width: 150px;height: 150px;background-color: rgba(0, 0, 0, 0.8);">
                        <img src="{{asset('/storage/'.$img->path)}}" alt="gallery" class="img-fluid h-100 m-3">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

