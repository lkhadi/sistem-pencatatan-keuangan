@extends('layout.master')
@section('title',$title)

@section('content')
<h5 class="text-center">Daftar Kategori</h5>
<hr>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('alert'))
<div class="alert alert-info">
	{{session('alert')}}
</div>
	
@endif
	<div class="row">
		<div class="col-md-6">
			<h5 class="text-center"><caption>Tabel Kategori Pemasukan</caption></h5>
			<table class="table table-sm table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Kategori</th>
						<th>Deskripsi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($list_kategori_pemasukan as $key => $kt)
					<tr>
						<td>{{++$key}}</td>
						<td>{{$kt->nama_kategori}}</td>
						<td>{{$kt->deskripsi}}</td>
						<td>
							<form action="{{url('kategori/'.$kt->id)}}" method="POST">
								@method('DELETE')
								@csrf
								<input type="hidden" name="tipe" value="pemasukan">
								<a href="{{url('kategori/'.$kt->id.'/edit?tipe=pemasukan')}}" class="btn btn-sm btn-info">Edit</a>
								<button type="submit" class="btn btn-sm btn-danger">Hapus</button>
							</form>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="col-md-6">
			<h5 class="text-center"><caption>Tabel Kategori Pengeluaran</caption></h5>
			<table class="table table-sm table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Kategori</th>
						<th>Deskripsi</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					@foreach($list_kategori_pengeluaran as $key => $kt)
					<tr>
						<td>{{++$key}}</td>
						<td>{{$kt->nama_kategori}}</td>
						<td>{{$kt->deskripsi}}</td>
						<td>
							<form action="{{url('kategori/'.$kt->id)}}" method="POST">
								@method('DELETE')
								@csrf
								<input type="hidden" name="tipe" value="pengeluaran">
								<a href="{{url('kategori/'.$kt->id.'/edit?tipe=pengeluaran')}}" class="btn btn-sm btn-info">Edit</a>
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