@extends('layouts.app')
@section('title','create album')
@section('content')

    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h2 style="color: blue;">Upload New Photo</h2>

                <form method="post" class="mt-4" enctype="multipart/form-data" action="{{route('photos.store')}}">
                    @csrf
                    <input type="hidden" value="{{$albumId}}" name="album_id">
                    <div class="my-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="enter photo name">
                    </div>

                    <div class="my-3">
                        <label for="photo" class="form-label">photo</label>
                        <input type="file" class="form-control" name="photo" id="photo" >
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
