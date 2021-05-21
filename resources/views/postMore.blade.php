@extends('layouts.app')

@section('content')

    <div class="container">
            <div class="row">
                <div class="card border mb-3">
                    <div class="card-header">
                        <a href="{{route('feed.show',['post'=> $user->id])}}" class="text-decoration-none text-dark">
                            <p class="font-weight-bold">Post Creator: {{$post_user->name}}</p>
                        </a>
                    </div>
                    <div class="d-flex">
                        <div class="avatar overflow-hidden rounded-circle m-4"
                             style="width: 100px;height: 100px;background-color: rgba(0, 0, 0, 0.8);">
                            <img src="{{$user->postImage ? asset('/storage/'.$user->postImage->path) : asset('/images/jungle.jpg')}}" alt="avatar" class="img-fluid h-100" id="userAvatar" style="object-fit: cover;">
                        </div>
                        <div class="post m-4" style="width: 500px;">
                            <div class="post-side">
                                <div class="font-weight-bold">
                                    <h2>{{$user->title}}</h2>
                                </div>
                                <div>
                                    <p class="font-weight-bold">Created:{{substr($user->created_at, 11, -3)}}</p>
                                </div>
                                <div>
                                    <p>{{$user->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
