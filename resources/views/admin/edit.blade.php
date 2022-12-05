@extends('admin.layout')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach
        </ul>
    </div>
@endif

<div class="card mt-4">
	<div class="card-body">

        <h5 class="card-title fw-bolder mb-3">Ubah Data Barang</h5>

		<form method="post" action="{{ route('admin.update', $data->id_barang) }}">
			@csrf
            <div class="mb-3">
                <label for="id_barang" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="id_barang" name="id_barang" value="{{ $data->id_barang }}">
            </div>
            <div class="mb-3">
                <label for="id_pengirim" class="form-label">ID Pengirim</label>
                <input type="text" class="form-control" id="id_pengirim" name="id_pengirim" value="{{ $data->id_pengirim }}">
            </div>
			<div class="mb-3">
                <label for="nama_barang" class="form-label">nama_barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="{{ $data->nama_barang }}">
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">jenis</label>
                <input type="text" class="form-control" id="jenis" name="jenis" value="{{ $data->jenis }}">
            </div>
            <div class="mb-3">
                <label for="berat" class="form-label">berat</label>
                <input type="text" class="form-control" id="berat" name="berat" value="{{ $data->berat }}">
            </div>
            <div class="mb-3">
                <label for="tujuan" class="form-label">tujuan</label>
                <input type="text" class="form-control" id="tujuan" name="tujuan" value="{{ $data->tujuan }}">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
            
		</form>
	</div>
</div>

@stop