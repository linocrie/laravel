@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">


                @foreach($posts as $value)

                    @if($value->user_id !== Auth::id())
                    <div class="row">
                        <div class="card border mb-3">
                            <div class="d-flex">
                                <div class="avatar overflow-hidden rounded-circle m-4"
                                     style="width: 100px;height: 100px;background-color: rgba(0, 0, 0, 0.8);">
                                    <img
                                        src="{{$value->postImage ? asset('/storage/'.$value->postImage->path) : asset('/images/jungle.jpg')}}"
                                        alt="avatar" class="img-fluid h-100" id="userAvatar" style="object-fit: cover;">
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
                                            <p>{{Str::limit($value->description),250}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-3">
                                    <a href="{{route('feed.view',['post'=> $value->id])}}" class="btn btn-dark">More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach


        </div>
        <div class="d-flex justify-content-center text-decoration-none m-5 ">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
