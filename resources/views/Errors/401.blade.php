<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Unauthorized</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,700" rel="stylesheet">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="assets/errors/css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>
<?php 
	$level_user = Session::get('level_user');
?>
<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>4  <span></span>  1</h1>
			</div>
			<h2>Oops! You're not authorized.</h2>
			<p>Maaf, kamu tidak diizinkan untuk mengakses halaman ini. Hanya pengguna tertentu yang diizinkan. Silahkan hubungi PIC Data Center untuk mengetahui informasi lebih lanjut.</p>
			@if($level_user == 0)
			<a href="{{route('dashboard-visitor')}}">Kembali ke home</a>
			@else
			<a href="{{route('approval-check-in')}}">Kembali ke home</a>
			@endif
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
