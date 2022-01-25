<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <title>Wahyu Room</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="icon" href="favicon.ico"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
          integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{asset('/assets_landing')}}/css/reset.css"/>
    <link rel="stylesheet" href="{{asset('/assets_landing')}}/css/fonts.css"/>
    <link rel="stylesheet" href="{{asset('/assets_landing')}}/css/font-icons.css"/>
    <link rel="stylesheet" href="{{asset('/assets_landing')}}/css/style.css"/>
    <link rel="stylesheet" href="{{asset('/assets_landing')}}/css/responsive.css"/>

</head>

<body class="body">
<!-- ---------- HEADER ---------- -->
<header>

    <div class="container">
        <div>
            <i class="icon-menu_bars"></i>
            <i class="icon-search"></i>
        </div>
        <nav>

            <button id="openForm">Login</button>
            <a href="{{url('/register')}}">
                <button style="margin-left: 20px" id="openFormReg">Registrasi</button>
            </a>
        </nav>
    </div>
</header>

<!-- ---------- MAIN ---------- -->
<main>
    <div class="container">
        <section>
            <h1><span class="title">Wahyu</span>Room</h1>
            <p>Website Booking Ruangan Terbaik di Ujung Berung</p>
            <nav>
                <div>
                    <p>Coffee Break</p>
                    <i class="icon-restaurants"></i>
                </div>
                <div>
                    <p>Lokasi Strategis</p>
                    <i class="icon-destination"></i>
                </div>
                <div>
                    <p>Layanan Ramah</p>
                    <i class="icon-forums"></i>
                </div>

            </nav>
        </section>

        @if($errors->any())
            <div style="margin-top: 20px; border:1px solid red; border-radius: 20px; padding: 20px;">
                <h4 style="color: red"> {!! implode('', $errors->all('<div>:message</div>')) !!}</h4>
            </div>

            <script>
                swal("Oh oh", "Login Gagal", "error");
            </script>
        @endif

        @if (session()->has('success'))

            <div style="margin-top: 20px; border:1px solid cornflowerblue; border-radius: 20px; padding: 20px;">
                <h4 style="color: black">     <strong>{{ Session::get('success') }}</strong></h4>
            </div>

        @endif


        @if(Request::is('/'))
            @include('landing.top_image')
        @endif
    </div>
</main>

@yield('main')


<!-- ---------- MODAL ---------- -->

<section id="modal">
    <div class="container-form">
        <i id="closeForm" class="icon-times"></i>
        <p>Login</p>

        <form class="contact-form" action="{{ route('login') }}" method="post">
            @csrf
            <label for="email">Login</label>
            <input type="email" name="email" id="email" required placeholder="E-mail"/>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password" required/>
            <button type="submit">Masuk</button>
        </form>
        <p class="cgv">
            Dengan melakukan login anda menyetujui syarat dan ketentuan kami
        </p>
    </div>
</section>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{asset('/assets_landing')}}/js/main.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>
