<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Sistem yang digunakan untuk mencatat pengeluaran dan pemasukan keuangan Anda.">
	<title>@yield('title') | Sistem Pencatatan Pengeluaran dan Pemasukan Keuangan</title>
	<link rel="icon" type="image/png" href="{{asset('images/icon.png')}}">
	<link rel="stylesheet" href="{{asset('css/app.css')}}">
	<style type="text/css">
		.box{
			box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.75);
		}
	</style>
</head>
<body>
	<div class="container" style="margin-bottom: 30px;">
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="{{url('/')}}">Home</a></li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Kategori</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="{{url('kategori')}}">List Kategori</a>
						<a class="dropdown-item" href="{{url('kategori/create')}}">Tambah Kategori</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">Transaksi</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="{{url('transaksi')}}">List Transaksi</a>
						<a class="dropdown-item" href="{{url('transaksi/create')}}">Tambah Transaksi</a>
					</div>
				</li>
			</ul>
		</nav>
	</div>
	<div class="container">
		@yield('content')
	</div>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
	@yield('script')
</body>
</html>