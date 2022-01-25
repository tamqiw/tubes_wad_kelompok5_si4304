<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/bootstrap.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('/frontend') }}/assets/css/app.css">
</head>

<body style="background-color: #FF8484 !important;">
<nav class="navbar navbar-light">
    <div class="container d-block">
        <a href="{{url('user')}}"><i class="bi bi-chevron-left"></i></a>
        <a class="navbar-brand ms-4" href="{{"/user"}}">
            <img src="{{ asset('/frontend') }}/WahyuRoom.svg">
        </a>
    </div>
</nav>

<div class="container">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{url('/user')}}">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldShow"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Home</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>

                </div>

                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{url('/booking/mybooking')}}">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Pesanan Saya</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-6 col-md-6">
                    <a href="{{url('hubungi-kami')}}">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Hubungi Kami</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-2">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{asset(Auth::user()->photo)}}"
                                 onerror="this.src='https://akumenulis.com/wp-content/uploads/2020/09/495-4952535_create-digital-profile-icon-blue-user-profile-icon.png';"
                                 alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{Auth::user()->name}}</h5>
                            <h6 class="text-muted mb-0">{{Auth::user()->email}}</h6>

                            <a href="{{url('/editprofile')}}" class="sidebar-link">
                                <h6 class="mt-3">Edit Profile</h6>
                            </a>
                            <a href="{{url('/logout')}}" class="sidebar-link">
                                <h6 class="mt-3">Logout</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

@yield('content')


<script src="{{ asset('/frontend') }}/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{ asset('/frontend') }}/assets/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('/frontend') }}/assets/vendors/apexcharts/apexcharts.js"></script>
<script src="{{ asset('/frontend') }}/assets/js/pages/dashboard.js"></script>

<script src="{{ asset('/frontend') }}/assets/js/main.js"></script>


<script src="{{ URL::to('frontend') }}/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="{{ URL::to('frontend') }}/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="{{ URL::to('frontend') }}/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>


<script>
    $('body').on("click", ".hide-modal", function () {
        $(".modal:visible").modal('toggle');
    });
</script>
</body>


</html>
