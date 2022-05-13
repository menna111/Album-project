<!DOCTYPE html>
<html lang="en">
@include('partials.header')

<body>
    <div class="container-fluid">
        <div class="row">
                @include('partials.nav')
            <div class ="container">
                @include('partials.message')
                @yield('content')
            </div>
            </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    @yield('scripts')


</body>



</html>
