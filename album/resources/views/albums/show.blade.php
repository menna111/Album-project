@extends('layouts.app')
@section('title','show album')
@section('content')

    <section style="background-color: #dbd8d8" class="jumbtron text-center p-5 my-3">
        <div class="container">
            <h1 class="jumbtron-heading">{{$album->name}} Album</h1>
            <p>
                <a href="{{route('photos.create',$album->id)}}" class="btn btn-primary my-2"> Upload Photo</a>
            </p>
        </div>
    </section>


    <div class="container">

        <div class="row mt-5">
        @forelse( $album->photos as $photo)

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="{{asset($photo->photo)}}" alt="photo" height="300px">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{route('photos.show',$photo->id)}}"  class="btn btn-sm btn-outline-secondary">View</a>
                            </div>
                            <small class="text-muted">{{$photo->name}}</small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <h3>no photos yet.</h3>

        @endforelse
    </div>
    </div>
@endsection
