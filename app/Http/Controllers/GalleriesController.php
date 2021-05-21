<?php

namespace App\Http\Controllers;

use App\Models\Galleries;
use App\Models\GalleriesImages;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleriesController extends Controller
{
    public function index()
    {
        $gallery = Galleries::where('user_id', Auth::id())->get()->load('galleriesImages');

        return view('galleries')
            ->with('gallery', $gallery);
    }

    public function create()
    {
        return view('galleriesCreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'gallery_images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);
        $gallery = Galleries::create(
            [
                'user_id' => auth()->user()->id,
                'title' => $request->title,
            ]
        );

        if ($request->hasfile('gallery_images')) {
            foreach ($request->file('gallery_images') as $gallery_images) {
                $path = $gallery_images->store('gallery');
                GalleriesImages::Create(
                    [
                        'galleries_id' => $gallery->id,
                        'img_original_name' => $gallery_images->getClientOriginalName(),
                        'path' => $path
                    ]
                );
            }
        }

        return redirect()->route('galleries.index');
    }


    public function edit(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'gallery_images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        Galleries::where('id',$request->id)->update(
            [
                'title' => $request->title,
            ]
        );
        if ($request->hasfile('gallery_images')) {
            foreach ($request->file('gallery_images') as $avatar) {
                $path = $avatar->store('gallery');
                GalleriesImages::Create(
                    [
                        'galleries_id' => $request->id,
                        'img_original_name' => $avatar->getClientOriginalName(),
                        'path' => $path,
                    ]
                );

            }
        }
        return redirect()->route('galleries.index');
    }

    public function delete($id) {

        Storage::delete(GalleriesImages::where('id',$id)->first()->path);
        GalleriesImages::where('id',$id)->delete();

        return back()
            ->with('success','Deleted');
    }

    public function destroy($id)
    {

        if(GalleriesImages::where('galleries_id', $id)->first()) {
            Storage::delete(GalleriesImages::where('galleries_id', $id)->pluck('path')->all());
            GalleriesImages::where('galleries_id', $id)->delete();
        }

        Galleries::where('id',$id)->delete();
        return back()
            ->with('success','Deleted');
    }

    public function show($id)
    {
        $gallery = Galleries::where('id',$id)->first()->load('galleriesImages');
        return view('galleriesEdit')
            ->with('gallery',$gallery);

    }
}
