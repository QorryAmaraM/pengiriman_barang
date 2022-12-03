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
                <label for="ID_PENGIRIM" class="form-label">ID Pengirim</label>
                <input type="text" class="form-control" id="ID_PENGIRIM" name="ID_PENGIRIM">
            </div>
			<div class="mb-3">
                <label for="NAMA_PENGIRIM" class="form-label">Nama Pengirim</label>
                <input type="text" class="form-control" id="NAMA_PENGIRIM" name="NAMA_PENGIRIM">
            </div>
            <div class="mb-3">
                <label for="ALAMAT_PENGIRIM" class="form-label">Alamat Pengirim</label>
                <input type="text" class="form-control" id="ALAMAT_PENGIRIM" name="ALAMAT_PENGIRIM">
            </div>
            <div class="mb-3">
                <label for="NOMOR_PENGIRIM" class="form-label">No Pengirim</label>
                <input type="text" class="form-control" id="NOMOR PENGIRIM" name="NO_PENGIRIM">
            </div>
            <div class="text-center">
				<input type="submit" class="btn btn-primary" value="Tambah" />
			</div>
		</form>
	</div>
</div>

@stop