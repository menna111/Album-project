

<div class="container">
        <div class="row ">
            <div class="col">
                <h2 style="color: blue;">Create New Album</h2>

                <form id="add" method="post" class="my-4" enctype="multipart/form-data" action="{{route('albums.store')}}">
                    @csrf

                    <div class="my-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="enter album name">


                    <div class="my-3">
                        <label for="cover_image" class="form-label">photo</label>
                        <input type="file" class="form-control" name="cover_image" id="cover_image" >
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

<script>
    $('#add').submit(function (e){
        e.preventDefault();

        var formData = new FormData(this);
        $.ajax({
            method:"POST",
            url:"{{ route('albums.store') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {

                if(response.status == true){
                    Swal.fire({
                        icon: 'success',
                        title: 'success',
                        text: response.msg,
                    })
                    window.location.reload();
                }else{
                    console.log(response.msg);
                    Swal.fire({
                        icon: 'error',
                        title: 'error',
                        text: response.msg,
                    })
                }

            }
        })
    })
</script>
