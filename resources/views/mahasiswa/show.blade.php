@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Mahasiswa</h1>
    <table class="table">
        <tr>
            <th>Nama</th>
            <td>{{ $mahasiswa->nama }}</td>
        </tr>
        <tr>
            <th>NPM</th>
            <td>{{ $mahasiswa->npm }}</td>
        </tr>
        <tr>
            <th>Nomor Telepon</th>
            <td>{{ $mahasiswa->nomor_telepon }}</td>
        </tr>
    </table>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection