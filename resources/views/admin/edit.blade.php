@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Jadwal</h1>
    <form action="{{ route('jadwal.update', $user->id) }}" method="POST" class="rounded bg-white p-4 shadow">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="hari" class="form-label">Hari</label>
            <input type="text" class="form-control" id="hari" name="hari" value="{{ $user->hari }}" required>
        </div>
        <div class="mb-3">
            <label for="jam_mulai" class="form-label">Jam Mulai</label>
            <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{ $user->jam_mulai }}" required>
        </div>
        <div class="mb-3">
            <label for="jam_selesai" class="form-label">Jam Selesai</label>
            <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{ $user->jam_selesai }}" required>
        </div>
        <div class="mb-3">
            <label for="ruangan" class="form-label">Ruangan</label>
            <input type="text" class="form-control" id="ruangan" name="ruangan" value="{{ $user->ruangan }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection