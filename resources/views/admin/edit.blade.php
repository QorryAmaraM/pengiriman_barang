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

		<form method="post" action="{{ route('admin.update', $data->ID_BARANG) }}">
			@csrf
            <div class="mb-3">
                <label for="ID_BARANG" class="form-label">ID Barang</label>
                <input type="text" class="form-control" id="ID_BARANG" name="ID_BARANG" value="{{ $data->ID_BARANG }}">
            </div>
            <div class="mb-3">
                <label for="ID_PENGIRIM" class="form-label">ID Pengirim</label>
                <input type="text" class="form-control" id="ID_PENGIRIM" name="ID_PENGIRIM">
            </div>
            <div class="mb-3">
                <label for="ID_PENERIMA" class="form-label">ID Penerima</label>
                <input type="text" class="form-control" id="ID_PENERIMA" name="ID_PENERIMA">
            </div>
			<div class="mb-3">
                <label for="NAMA_BARANG" class="form-label">Nama_Barang</label>
                <input type="text" class="form-control" id="NAMA_BARANG" name="NAMA_BARANG" value="{{ $data->NAMA_BARANG }}">
            </div>
            <div class="mb-3">
                <label for="JENIS" class="form-label">Jenis</label>
                <input type="text" class="form-control" id="JENIS" name="JENIS" value="{{ $data->JENIS }}">
            </div>
            <div class="mb-3">
                <label for="BERAT" class="form-label">Berat</label>
                <input type="text" class="form-control" id="BERAT" name="BERAT" value="{{ $data->BERAT }}">
            </div>
            <div class="mb-3">
                <label for="TUJUAN" class="form-label">Tujuan</label>
                <input type="text" class="form-control" id="TUJUAN" name="TUJUAN">
            </div>
			<div class="text-center">
				<input type="submit" class="btn btn-primary" value="Ubah" />
			</div>
            
		</form>
	</div>
</div>

@stop