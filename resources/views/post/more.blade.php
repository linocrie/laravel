@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="card border mb-3">
                <div class="card-header">
                    <a href="{{route('feed.show',['profile'=> $posts->user_id])}}" class="text-decoration-none text-dark">
                        <p class="font-weight-bold">Post Creator: {{$post_user->name}}</p>
                    </a>
                </div>
                <div class="d-flex">
                    <div class="avatar overflow-hidden rounded-circle m-4"
                         style="width: 100px;height: 100px;background-color: rgba(0, 0, 0, 0.8);">
                        <img
                            src="{{$posts->postImage ? asset('/storage/'.$posts->postImage->path) : asset('/images/jungle.jpg')}}"
                            alt="avatar" class="img-fluid h-100" id="userAvatar" style="object-fit: cover;">
                    </div>
                    <div class="post m-4" style="width: 500px;">
                        <div class="post-side">
                            <div class="font-weight-bold">
                                <h2>{{$posts->title}}</h2>
                            </div>
                            <div>
                                <p class="font-weight-bold">Created:{{substr($posts->created_at, 11, -3)}}</p>
                            </div>
                            <div>
                                <p class="font-weight-bold mr-2">Description:</p>
                                <p>{{$posts->description}}</p>
                            </div>
                            <div class="d-flex">
                                <p class="font-weight-bold mr-2">Professions: </p>
                                @foreach($posts->professions as $profession)
                                    <p>{{$profession->name}}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
