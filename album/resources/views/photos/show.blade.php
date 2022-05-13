@extends('layouts.app')
@section('title','show album')
@section('content')

    <div class="container">
        <div class="row my-4">
            <div class="col">
                <h2>{{$photo->name}}</h2>
                <hr>
                        <form method="post"  action="{{route('photos.destroy',$photo->id)}}" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger m-3"> DELETE</button>
                        </form>

                <img src="{{asset($photo->photo)}}" alt="photo" height="500px" width="100%" >

            </div>
        </div>
    </div>
@endsection
