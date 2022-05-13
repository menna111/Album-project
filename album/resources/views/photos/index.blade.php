@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row mt-5">
            @forelse($photos as $photo)

            <div class="col-md-4">
                <div class="card shadow-sm">
                    <img src="{{$photo->photo}}" alt="photo" height="300px">
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
