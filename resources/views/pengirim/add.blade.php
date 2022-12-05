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

        <h5 class="card-title fw-bolder mb-3">Tambah Pengirim</h5>

		<form method="post" action="{{ route('pengirim.store') }}">
			@csrf
            <div class="mb-3">
                <label for="id_pengirim" class="form-label">ID Pengirim</label>
                <input type="text" class="form-control" id="id_pengirim" name="id_pengirim">
            </div>
			<div class="mb-3">
                <label for="nama_pengirim" class="form-label">Nama Pengirim</label>
                <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim">
            </div>
            <div class="mb-3">
                <label for="alamat_pengirim" class="form-label">Alamat Pengirim</label>
                <input type="text" class="form-control" id="alamat_pengirim" name="alamat_pengirim">
            </div>
            <div class="mb-3">
                <label for="nomor_pengirim" class="form-label">No Pengirim</label>
                <input type="text" class="form-control" id="nomor_pengirim" name="nomor_pengirim">
            </div>
            <div class="text-center">
				<input type="submit" class="btn btn-primary" value="Tambah" />
			</div>
		</form>
	</div>
</div>

@stop