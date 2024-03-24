<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hostel Management System</title>

	<!-- JS -->
	<script src="{{asset('//code.jquery.com/jquery-1.11.1.min.js')}}"></script>
	<script src="{{asset('js/moment.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.js"></script>
	<script src="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="{{asset('js/bootstrap.datetime.js')}}"></script>
	<script src="{{asset('js/bootstrap.password.js')}}"></script>
	<script src="{{asset('js/scripts.js')}}"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap.datetimepicker.css')}}">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.css">
	<link rel="stylesheet" href="//cdn.datatables.net/plug-ins/1.10.7/integration/bootstrap/3/dataTables.bootstrap.css">
	<link rel="stylesheet" href="{{asset('css/styles.css')}}">

	<style>
		@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);
		body, h1, h2, h3, h4, h5, h6{
			font-family: 'Open Sans', sans-serif;
		}
	</style>

</head>

<body background="{{ asset("images/front_logo.jpg") }}" style="background-repeat: no-repeat; background-position: center; background-color: black">
	<div class="container">