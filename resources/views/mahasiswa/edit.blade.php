@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Mahasiswa</h1>
    <form action="{{ route('mahasiswa.update', $mahasiswa->npm) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" value="{{ $mahasiswa->nama }}" required>
        </div>
        <div class="form-group">
            <label for="npm">NPM</label>
            <input type="text" name="npm" id="npm" class="form-control" value="{{ $mahasiswa->npm }}" readonly>
        </div>
        <div class="form-group">
            <label for="nomor_telepon">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control" value="{{ $mahasiswa->nomor_telepon }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection