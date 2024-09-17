@include('layouts.header')
<link rel="stylesheet" href="{{ asset("css/mainlayout.css")}}">
<main>
    @yield('content')
</main>

@include('layouts.footer')
