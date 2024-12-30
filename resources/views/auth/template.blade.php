<!DOCTYPE html>
<html lang="en">

<head>

    @include('include.meta')

    <title>@yield('title')</title>

    @include('include.css')

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image">
                        @yield('picture')
                    </div>
                    <div class="col-lg-7">
                        @yield('content')
                        
                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('include.js')

</body>

</html>