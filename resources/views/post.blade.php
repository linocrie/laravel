@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="button mb-5 d-flex flex-row-reverse">
            <a href="{{route('posts.create')}}" class="btn btn-dark">Create New Post</a>
        </div>
        @if(!$user)
            <p>No Posts</p>
        @endif
        @foreach($user as $value)
        <div class="row">
                <div class="card border mb-3">
                    <div class="d-flex">
                        <div class="avatar overflow-hidden rounded-circle m-4"
                             style="width: 100px;height: 100px;background-color: rgba(0, 0, 0, 0.8);">
                            <img src="{{$value->postImage ? asset('/storage/'.$value->postImage->path) : asset('/images/jungle.jpg')}}" alt="avatar" class="img-fluid h-100" id="userAvatar" style="object-fit: cover;">
                        </div>
                        <div class="post m-4" style="width: 500px;">
                            <div class="post-side">
                                <div class="font-weight-bold">
                                    <h2>{{$value->title}}</h2>
                                </div>
                                <div>
                                    <p class="font-weight-bold">Created:{{substr($value->created_at, 11, -3)}}</p>
                                </div>
                                <div>
                                    <p>{{$value->description}}</p>
                                </div>
                            </div>
                        </div>
                        <form action="{{route('posts.delete',['id'=> $value->id])}}" method="POST" enctype="multipart/form-data" class="m-3">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-dark">Delete</button>
                        </form>
                        <div class="m-3">
                            <a href="{{route('posts.show',['id'=> $value->id])}}" class="btn btn-dark">Edit</a>
                        </div>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
@endsection
