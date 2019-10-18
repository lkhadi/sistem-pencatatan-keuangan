<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Sistem yang digunakan untuk mencatat pengeluaran dan pemasukan keuangan Anda.">
	<title>@yield('title') | Sistem Pencatatan Pengeluaran dan Pemasukan Keuangan</title>
	<link rel="icon" type="image/png" href="{{asset('images/icon.png')}}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	@yield('script')
</body>
</html>