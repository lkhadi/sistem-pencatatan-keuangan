@extends('layout.master')
@section('title',$title)

@section('content')
<h5 class="text-center">Daftar Transaksi {{$caption}}</h5>
@if(session('alert'))
<div class="alert alert-info">
	{{session('alert')}}
</div>
@endif
<div class="row">
	<div class="col-md-9">
		<form action="{{url('transaksi')}}" method="GET" class="form-inline">
			@csrf
			<label class="mr-sm-5"><strong>Filter :</strong></label>
			<label class="mr-sm-2">Start :</label>
			<input type="date" name="mulai" required="" class="form-control mr-sm-2 mb-2">
			<label class="mr-sm-2">End :</label>
			<input type="date" name="akhir" required="" class="form-control mr-sm-2 mb-2">
			<button type="submit" class="btn btn-sm btn-info">Filter</button>
		</form>
	</div>
	<div class="col-md-3">
		<h4 class="text-info">Saldo : Rp {{number_format($saldo,0,'.','.')}}</h4>
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-6">
		<h5 class="text-center"><caption>Pemasukan</caption></h5>
		<table class="table table-sm table-hover table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Pemasukan</th>
					<th>Deskripsi</th>
					<th>Kategori</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pemasukan as $key => $p)
				<tr>
					<td>{{++$key}}</td>
					<td>Rp {{number_format($p->pemasukan,0,'.','.')}}</td>
					<td>{{$p->deskripsi}}</td>
					<td>{{$p->kategori->nama_kategori}}</td>
					<td>
						<form action="{{url('transaksi/'.$p->id)}}" method="POST">
							@method('DELETE')
							@csrf
							<input type="hidden" name="tipe" value="pemasukan">
							<a href="{{url('transaksi/'.$p->id.'/edit?tipe=pemasukan')}}" class="btn btn-sm btn-info">Edit</a>
							<button type="submit" class="btn btn-sm btn-danger">Hapus</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="col-md-6">
		<h5 class="text-center"><caption>Pengeluaran</caption></h5>
		<table class="table table-sm table-hover table-striped table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Pemasukan</th>
					<th>Deskripsi</th>
					<th>Kategori</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pengeluaran as $key => $p)
				<tr>
					<td>{{++$key}}</td>
					<td>Rp {{number_format($p->pengeluaran,0,'.','.')}}</td>
					<td>{{$p->deskripsi}}</td>
					<td>{{$p->kategori->nama_kategori}}</td>
					<td>
						<form action="{{url('transaksi/'.$p->id)}}" method="POST">
							@method('DELETE')
							@csrf
							<input type="hidden" name="tipe" value="pengeluaran">
							<a href="{{url('transaksi/'.$p->id.'/edit?tipe=pengeluaran')}}" class="btn btn-sm btn-info">Edit</a>
							<button type="submit" class="btn btn-sm btn-danger">Hapus</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection