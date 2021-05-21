@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="button mb-5 d-flex flex-row-reverse">
            <a href="{{route('galleries.create')}}" class="btn btn-light font-weight-bold text-danger">Create New Gallery</a>
        </div>
        @if(!$gallery)
            <p>No Galleries</p>
        @endif
        <div class="d-flex flex-wrap">
            @foreach($gallery as $value)
                <div class="">
                    <div class="mb-3 m-3 p-2">
                        <div class="d-flex align-items-center flex-column ">

                            <div class="title d-flex">
                                <p class="font-weight-bold text-light" style="font-size: 20px">{{$value->title}}</p>
                                <form action="{{route('galleries.destroy', ['id'=> $value->id])}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('DELETE')
                                    <div class="delete">
                                        <button class="btn text-danger">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <a href="{{route('galleries.show',['id'=> $value->id])}}">
                                <div class="d-flex justify-content-center align-items-center overflow-hidden rounded-circle mb-3"
                                     style="width: 150px;height: 150px;background-color: rgba(0, 0, 0, 0.8);">
                                    <img src="{{$value->galleriesImages ? asset('/storage/'.$value->galleriesImages[0]->path) : asset('/images/gallery/universe.jpg')}}" alt="gallery" class="img-fluid h-100 m-3">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
