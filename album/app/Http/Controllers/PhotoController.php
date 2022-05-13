<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Traits\ImageUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos=Photo::all();
        return view('photos.index',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($albumId)
    {
        return view('photos.create',compact('albumId'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate([
            'name'=>'required|min:3|max:50',
            'photo'=>'required|image',
        ]);


        $photo=  Photo::create([
            'name' =>$request->post('name'),
            'album_id'=>$request->post('album_id'),
            'photo' =>$this->uploadImage($request->file('photo'),'album/photos',50),
        ]);

        return redirect('/albums/' .$request->input('album_id'))->with('success','photo uploaded successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo=Photo::findOrFail($id);
        return view('photos.show',compact('photo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo=Photo::findOrFail($id);
        $photo->delete();
       Storage::delete('/public/albums/photos/'.$photo->album_id.'/'.$photo->photo);

        return redirect('/photos')->with('success','photo deleted successfully');
    }
}
