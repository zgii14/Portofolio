@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Jadwal</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nama: {{ $user->name }}</h5>
            <p class="card-text">Hari: {{ $user->hari }}</p>
            <p class="card-text">Jam Mulai: {{ $user->jam_mulai }}</p>
            <p class="card-text">Jam Selesai: {{ $user->jam_selesai }}</p>
            <p class="card-text">Ruangan: {{ $user->ruangan }}</p>
            <a href="{{ route('jadwal.index') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
@endsection