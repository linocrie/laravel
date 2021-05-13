
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="button mb-5 d-flex flex-row-reverse">
            <a href="{{route('posts.store')}}" class="btn btn-dark">Create New Post</a>
        </div>
        @if(!$user)
            <p>No Posts</p>
        @endif

        @foreach($user as $post)
        <div class="row">
                <div class="card border mb-3">
                    <div class="d-flex">
                        <div class="avatar overflow-hidden rounded-circle m-4"
                             style="width: 100px;height: 100px;background-color: rgba(0, 0, 0, 0.8);">
                            <img src="{{asset('/storage/'.$post_path)}}" alt="avatar" class="img-fluid h-100" id="userAvatar" style="object-fit: cover;">
                        </div>
                        <div class="post m-4">
                            <div class="post-side">
                                <div class="font-weight-bold">
                                    <h2>{{$post->title}}</h2>
                                </div>
                                <div>
                                    <p class="font-weight-bold">Created:{{substr($post->created_at, 11, -3)}}</p>
                                </div>
                                <div>
                                    <p>{{$post->description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        @endforeach

    </div>
@endsection
