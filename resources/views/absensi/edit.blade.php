@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Absensi Mahasiswa</h1>
    <form action="{{ route('absensi.update', $absensi->id) }}" method="POST" class="rounded bg-white p-4 shadow">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="npm" class="form-label">Nama Mahasiswa</label>
            <select name="npm" id="npm" class="form-control" required>
                @foreach ($mahasiswas as $mahasiswa)
                    <option value="{{ $mahasiswa->npm }}" {{ $mahasiswa->npm == $absensi->npm ? 'selected' : '' }}>{{ $mahasiswa->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="pertemuan" class="form-label">Pertemuan</label>
            <input type="number" class="form-control" id="pertemuan" name="pertemuan" value="{{ $absensi->pertemuan }}" min="1" max="8" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <select name="keterangan" id="keterangan" class="form-control" required>
                <option value="hadir" {{ $absensi->keterangan == 'hadir' ? 'selected' : '' }}>Hadir</option>
                <option value="izin" {{ $absensi->keterangan == 'izin' ? 'selected' : '' }}>Izin</option>
                <option value="sakit" {{ $absensi->keterangan == 'sakit' ? 'selected' : '' }}>Sakit</option>
                <option value="alpa" {{ $absensi->keterangan == 'alpa' ? 'selected' : '' }}>Alpa</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection