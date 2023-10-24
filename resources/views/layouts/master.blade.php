<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'ร้านขายสัตว์เลี้ยง')</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/angular.min.js') }}"></script>

</head>

<body>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <div class="container">


        <nav class="navbar navbar-default navbar-static-top">


            <div class="navbar-header">
                <a class="navbar-brand" href="#">BikeShop</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">

                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('home') }}">หน้าแรก</a></li> @guest
                    @else
                        <li><a href="{{ URL::to('pet') }}">ข้อมูลสินค้า </a></li>
                    <li><a href="#">รายงาน</a></li>@endguest
                    <ul class="nav navbar-nav navbar-right"> @guest
                            <li><a href="{{ route('login') }}">ล็อกอิน</a></li>
                            <li><a href="{{ route('register') }}">ลงทะเบียน</a></li>
                        @else
                            <li><a href="#">{{ Auth::user()->name }} </a></li>
                        <li><a href="{{ URL::to('logout') }}">ออกจากระบบ </a></li> @endguest
                    </ul>

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ URL::to('cart/view') }}"><i class="fa fa-shopping-cart"></i> ตะกร้า
                            <span class="label label-danger">

                                @if (Session::has('cart_items'))
                                    {!! count(Session::get('cart_items')) !!}
                                @else
                                    {{ count([]) }}
                                @endif

                            </span></a></li>
                </ul>

            </div>
            <div class="name">
                <h3>นายธนภัทร รัตนแสง 6406021630021</h3>
            </div>
        </nav>@yield('content')

        @if (session('msg'))
            @if (session('ok'))
                <script>
                    toastr.success("{{ session('msg') }}")
                </script>
            @else
                <script>
                    toastr.error("{{ session('msg') }}")
                </script>
            @endif
        @endif

    </div>
</body>

</html>
