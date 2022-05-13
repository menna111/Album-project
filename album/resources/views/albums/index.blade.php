@extends('layouts.app')
@section('title','albums')

@section('content')

    <div class="container" >
        <a href="{{route('albums.create')}}" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#album" id="addAlbum" >Add album</a>

        <div class="row mt-4">
            @forelse($albums as $album)
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <img src="{{asset($album->cover_image)}}" alt="cover_image" height="300px">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{route('albums.show',$album->id)}}"  class="btn btn-sm btn-outline-secondary "
                                    >View</a>

                                    <a href="" type="button" class="btn btn-sm btn-outline-secondary"
                                       data-bs-toggle="modal" data-bs-target="#album" id="addAlbum"
                                       onclick="editAlbum({{$album->id}})">Edit</a>

                                    <form action="{{ route('albums.destroy', $album->id) }}" method="POST" class="d-none" id="delete_form">
                                        @csrf
                                        @method('DELETE')
                                    </form>


                                    <a href="#"  class="btn btn-sm btn-outline-danger delete_album" data-album-id="{{ $album->id }}" data-photos="{{ $album->photos->count() }}">DElEtE</a>
                                </div>
                                <small class="text-muted">{{$album->name}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h3>no albums yet.</h3>

            @endforelse
        </div>


        <!-- Modal -->
        <div  class="modal fade" id="album" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="content">

                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addAlbum').click((e)=>{
            e.preventDefault()
            $.ajax({
                type: "GET",
                url: `{{route('albums.create')}}`,
                success:function (response){
                    console.log('success');
                    $('#content').html(response)

                }
            })
        });

        function editAlbum(id) {

            $.ajax({
                type: "GET",
                url: "{{url('/albums')}}" + "/" + id + "/edit",
                success: function (response) {
                    $('#content').html(response)
                }

            })
        }


        $('.delete_album').on('click', function (event) {
            var album_id = $(this).data('album-id')
            event.preventDefault()


            if($(this).data('photos') > 0) {
                swal({
                    title: 'The album has photos, are you sure that you want to delete?',
                    confirmButtonText:  'yes',
                    cancelButtonText:  'transfer photos to another album',
                    showCancelButton: true,
                    showCloseButton: true,
                    padding: '2em',
                }).
                then(function (e) {
                    if (e.value === true) {
                        $('#delete_form').submit()
                    } else {
                        window.location.href = "/albums/" + album_id + "/transfer";


                    }

                },  function (dismiss) {
                    return false;
                });
            } else {
                $('#delete_form').submit()
            }

        })


    </script>

@endsection
