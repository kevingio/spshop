<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('page-title')</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/png" href="{{ asset('app-asset/images/icons/favicon.png') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>
<body class="animsition">

	@include('layouts.parts.header')
    @yield('content')
    @include('layouts.parts.footer')

	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="fa fa-angle-up" aria-hidden="true"></i>
		</span>
	</div>

	<div id="dropDownSelect1"></div>
    <div id="dropDownSelect2"></div>

	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</body>
</html>
