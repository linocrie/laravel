@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="button mb-5 d-flex flex-row-reverse">
            <a href="{{route('posts.create')}}" class="btn btn-light text-danger font-weight-bold">Create New Post</a>
        </div>
        @if(!$posts)
            <p>No Posts</p>
        @endif
        @foreach($posts as $post)
            <div class="row">
                <div class="card bg-secondary mb-3">
                    <div class="d-flex">
                        <div class="avatar overflow-hidden rounded-circle m-4"
                             style="width: 100px;height: 100px;background-color: rgba(0, 0, 0, 0.8);">
                            <img
                                src="{{$post->postImage ? asset('/storage/'.$post->postImage->path) : asset('/images/jungle.jpg')}}"
                                alt="avatar" class="img-fluid h-100" id="userAvatar" style="object-fit: cover;">
                        </div>
                        <div class="post m-4" style="width: 500px;">
                            <div class="post-side">
                                <div class="font-weight-bold">
                                    <h2>{{$post->title}}</h2>
                                </div>
                                <div>
                                    <p class="font-weight-bold">Created:{{substr($post->created_at, 11, -3)}}</p>
                                </div>
                                <div>
                                    <p>{{Str::limit($post->description),250}}</p>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('posts.delete',['post'=> $post->id])}}" method="POST"
                              enctype="multipart/form-data" class="m-3">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                        <div class="m-3">
                            <a href="{{route('posts.show',['post'=> $post->id])}}" class="btn btn-dark">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
