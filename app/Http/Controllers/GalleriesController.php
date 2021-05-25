<?php

namespace App\Http\Controllers;

use App\Http\Requests\GalleryRequest;
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
        $gallery = Galleries::with('galleriesImages')->where('user_id', Auth::id())->get();
        return view('gallery.galleries')
            ->with('gallery', $gallery);
    }

    public function create()
    {
        return view('gallery.create');
    }

    public function store(GalleryRequest $request)
    {
        $gallery = Galleries::create([
                'user_id' => auth()->id(),
                'title' => $request->title,
        ]);

        if ($request->hasfile('gallery_images')) {
            foreach ($request->file('gallery_images') as $gallery_images) {
                $path = $gallery_images->store('gallery');
                $gallery->galleriesImages()->create([
                    'galleries_id' => $gallery->id,
                    'img_original_name' => $gallery_images->getClientOriginalName(),
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('galleries.index');
    }

    public function show(Galleries $gallery)
    {
        return view('gallery.edit')
            ->with('gallery',$gallery);
    }

    public function edit(GalleryRequest $request, Galleries $gallery)
    {
        $gallery->where('id',$request->id)->update([
            'title' => $request->title,
        ]);
        if ($request->hasfile('gallery_images')) {
            foreach ($request->file('gallery_images') as $avatar) {
                $path = $avatar->store('gallery');
                $gallery->galleriesImages()->create([
                    'galleries_id' => $request->id,
                    'img_original_name' => $avatar->getClientOriginalName(),
                    'path' => $path,
                ]);
            }
        }
        return redirect()->route('galleries.index');
    }

    public function delete(GalleriesImages $image) {
        Storage::delete($image->path);
        $image->delete();

        return back()
            ->with('success','Deleted');
    }

    public function destroy(Galleries $gallery)
    {
        $galleries_images = $gallery->galleriesImages()->where('galleries_id', $gallery->id);
        if($galleries_images) {
            Storage::delete($galleries_images->pluck('path')->all());
            $galleries_images->delete();
        }
        $gallery->where('id',$gallery->id)->delete();
        return back()
            ->with('success','Deleted');
    }
}
