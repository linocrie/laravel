@extends('layouts.app')

@section('content')
    <div class="container">
        @if(session('success'))
            <span class="alert alert-success d-flex justify-content-center p-2">{{ session('success') }}</span>
        @endif
        <div class="d-flex flex-column align-items-center">
            <div class="avatar d-flex justify-content-center align-items-center overflow-hidden rounded-circle mb-3"
                 style="width: 200px;height: 200px;background-color: rgba(0, 0, 0, 0.8);">
                <img src="{{asset('/storage/'. $user_path)}}" alt="avatar" class="img-fluid h-100 m-3" id="userAvatar">
            </div>
            <div class="m-4 mb-5">
                <p class="font-weight-bold text-light" style="font-size: 30px">{{ $user_post->name }}</p>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="col-md-6">
                <div class="text-center">
                    <p class="font-weight-bold text-light" style="font-size: 20px">All Information</p>
                </div>
                <div class="">
                    <p class="font-weight-bold text-light"><span style="font-size: 20px">Email:</span> {{$user_post->email}}</p>
                </div>
                <div>
                    <p class="font-weight-bold text-light"><span style="font-size: 20px">Phone: </span>{{$user_post->detail->phone}}</p>
                </div>
                <div>
                    <p class="font-weight-bold text-light"><span style="font-size: 20px">Address: </span>{{$user_post->detail->address}}
                    </p>
                </div>
                <div>
                    <p class="font-weight-bold text-light"><span style="font-size: 20px">City: </span>{{$user_post->detail->city}}</p>
                </div>
                <div>
                    <p class="font-weight-bold text-light"><span style="font-size: 20px">Country:</span> {{$user_post->detail->country}}
                    </p>
                </div>
                <div>
                    <p class="font-weight-bold text-light"><span
                            style="font-size: 20px">Professions:</span> {{$user_post->detail->professions}}</p>
                </div>
            </div>
            <div class="gallery col-md-6 text-center text-light">
                <div>
                    <p class="font-weight-bold" style="font-size: 20px">Gallery</p>
                </div>
                <div class="d-flex flex-wrap">
                    @foreach($gallery as $value)
                        <div class="mb-3 m-3 p-2">
                            <div class="d-flex align-items-center flex-column ">
                                <div class="title d-flex">
                                    <p class="font-weight-bold text-light" style="font-size: 20px">{{$value->title}}</p>
                                </div>
                                <a href="{{route('galleries.show',['id'=> $value->id])}}">
                                    <div class="d-flex justify-content-center align-items-center overflow-hidden rounded-circle mb-3"
                                         style="width: 150px;height: 150px;background-color: rgba(0, 0, 0, 0.8);">
                                        <img src="{{$value->galleriesImages ? asset('/storage/'.$value->galleriesImages[0]->path) : asset('/images/gallery/universe.jpg')}}" alt="gallery" class="img-fluid h-100 m-3">
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

@endsection
