<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Traits\ImageUpload;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AlbumController extends Controller
{
    use ImageUpload,ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums=Album::all();
        return view('albums.index',compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');

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

        $validator = Validator::make($request->all(), [
            'name'=>'required|min:3|max:50',
            'cover_image'=>'required|image',
        ]);
        if ($validator->fails()) {
            return $this->returnError($validator->errors()->all());
        }


        Album::create([
           'name' =>$request->post('name'),
           'cover_image' =>$this->uploadImage($request->file('cover_image'),'album/cover_image',50),
        ]);

//        return redirect('/albums')->with('success','album created successfully');
      return  $this->returnSuccess('album added successfully',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $album=Album::findOrFail($id);

        return view('albums.show',compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $album= Album::findOrFail($id);
       return view('albums.edit',compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        //validation
        $validator = Validator::make($request->all(), [
            'name'=>'required|min:3|max:50',
            'cover_image'=>'nullable|image',
        ]);
        if ($validator->fails()) {
            return $this->returnError($validator->errors()->all());
        }



        $album=Album::find($id);

        if($album != null) {
            if ($request->has('cover_image')){
                File::delete($album->cover_image);
                $cover_image= $this->uploadImage($request->file('cover_image'),'album/cover_image',50);

            }else{
                $cover_image=$album->cover_image;
            }


            $album->update([
                'name' =>$request->post('name'),
                'cover_image' =>$cover_image,
            ]);

                return  $this->returnSuccess('album updated suuccessfully',201);
        } else {
            return $this->returnError('not found', 200);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album=Album::FindOrFail($id);
        File::delete($album->cover_image);
        $album->delete();
        return redirect('/albums')->with('success','album deleted successfully');
    }




    public function transfer($id){
        $albums=Album::where('id','!=',$id)->get();
        return view('albums.transfer',compact('albums','id'));

    }

    public function change(int $id, Request $request) {
        $request->validate([
            'album_id' => 'required'
        ]);
        $album = Album::findOrfail($id);
        foreach ($album->photos as $photo) {
            $photo->album_id = $request->album_id;
            $photo->save();
        }
        $album->delete();
        return redirect()->route('albums.index')->with('success', 'album deleted successfully');
    }
}
