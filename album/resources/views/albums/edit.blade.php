{{--@extends('layouts.app')--}}
{{--@section('title','update album')--}}
{{--@section('content')--}}

    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <h2 style="color: blue;">Update Album</h2>
                <form id="edit_album" method="post" class="mt-4" enctype="multipart/form-data" action="{{route('albums.update',$album->id)}}">
                    @csrf
                    <div class="my-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$album->name}}" >
                    </div>

                    <div class="my-3">
                        <label for="cover_image" class="form-label">photo</label>
                        <input type="file" class="form-control" name="cover_image" id="cover_image" >
                        <img src="{{asset($album->cover_image)}}" alt="cover_image" width="100px" height="100px">
                    </div>

                    <button type="submit" class="btn btn-primary" id="submit_form">Submit</button>
                </form>
            </div>
        </div>
    </div>
{{--@endsection--}}



<script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#edit_album').submit(function (e) {
        e.preventDefault()
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: `{{ route('albums.update', $album->id) }}`,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response)
                if (response.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'success!',
                        text: response.msg,

                    })
                    window.location.reload();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'error',
                        text: response.msg,
                    })
                }
            }
        });
    })
</script>
