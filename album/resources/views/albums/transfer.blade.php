@extends('layouts.app')
@section('title','albums')

@section('content')
<div class="container">
    <form id="add" method="post" class="my-4" enctype="multipart/form-data" action="{{route('albums.change', $id)}}">
        @csrf
        <div class="my-3">
            <label for="album_id" class="form-label">Choose Album</label>
            <select class="form-control" name="album_id" id="album_id" style="width: 40%" required>
                @foreach($albums as $album)
                    <option value="{{ $album->id }}">{{ $album->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary" id="submit_form">Submit</button>
    </form>

</div>
    @endsection
