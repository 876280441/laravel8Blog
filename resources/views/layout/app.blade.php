<html>
<head>
    <title>@yield('title','博客')</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    @include('layout.style')
</head>
<body>
@include('layout.header')
<section></section>
<div>
    @yield('content')
</div>
@include('layout.footer')
@include('layout.script')
</body>
</html>
