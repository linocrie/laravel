@extends('layouts.app')

@section('content')
   <div class="container">
       <form method="POST" action="{{ route('posts.store')}}" enctype="multipart/form-data">
           @csrf
           <div class="form-group row">
               <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>
               <div class="col-md-6">
                   <input id="title" type="text"
                          class="form-control @error('title') is-invalid @enderror" name="title"
                          required autofocus>
               </div>
           </div>
           <div class="form-group row">
               <label for="description"
                      class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
               <div class="col-md-6">
                   <textarea name="description" id="description" class="form-control @error('desc') is-invalid @enderror" required autofocus></textarea>
               </div>
           </div>
           <div class="form-group d-flex">
               <label for="image"
                      class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
               <div class="col-md-6">
                   <input type="file" name="avatar" class="w-100 custom-file-input @error('avatar') is-invalid @enderror"
                          id="myAvatar">
                   @error('avatar')
                   <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                   </span>
                   @enderror
                   <label class="custom-file-label" for="myAvatar">Choose file</label>
               </div>
           </div>
           <div class="form-group row">
               <label for="profession"
                      class="col-md-4 col-form-label text-md-right">{{ __('Professions') }}</label>
               <div class="col-md-6">
                   <select class="mdb-select colorful-select js-example-basic-multiple w-100 "
                           name="professions[]"
                           multiple="multiple">
                       @foreach($professions as $value)
                           <option value="{{ $value['id'] }}">{{ $value['name'] }}</option>
                       @endforeach
                   </select>
               </div>
           </div>
            <div class="text-center mt-5">
                <button type="submit" class="btn btn-dark">Create</button>
            </div>
       </form>
   </div>
@endsection
