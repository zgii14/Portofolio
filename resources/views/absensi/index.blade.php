@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Absensi Mahasiswa</h1>

    <div class="mb-3">
        @for ($i = 1; $i <= 8; $i++)
            <a href="{{ route('absensi.index', ['pertemuan' => $i]) }}" class="btn btn-secondary {{ $pertemuan == $i ? 'active' : '' }}">
                Pertemuan {{ $i }}
            </a>
        @endfor
        <a href="{{ url('/absensi/rekap') }}" class="btn btn-secondary">
            Rekap Nilai
        </a>
        
    </div>
    <h2>Pertemuan {{ $pertemuan }}</h2>
    <form action="{{ route('absensi.store') }}" method="POST">
        @csrf
        <input type="hidden" name="pertemuan" value="{{ $pertemuan }}">
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>NPM</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mahasiswas as $mahasiswa)
                    @php
                        $absensiMahasiswa = $absensi->firstWhere(function ($item) use ($mahasiswa, $pertemuan) {
                            return $item->npm == $mahasiswa->npm && $item->pertemuan == $pertemuan;
                        });
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $mahasiswa->nama }}</td>
                        <td>{{ $mahasiswa->npm }}</td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="absensi[{{ $mahasiswa->npm }}][keterangan]" id="hadir_{{ $mahasiswa->npm }}" value="hadir" {{ $absensiMahasiswa && $absensiMahasiswa->keterangan == 'hadir' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="hadir_{{ $mahasiswa->npm }}">Hadir</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="absensi[{{ $mahasiswa->npm }}][keterangan]" id="izin_{{ $mahasiswa->npm }}" value="izin" {{ $absensiMahasiswa && $absensiMahasiswa->keterangan == 'izin' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="izin_{{ $mahasiswa->npm }}">Izin</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="absensi[{{ $mahasiswa->npm }}][keterangan]" id="sakit_{{ $mahasiswa->npm }}" value="sakit" {{ $absensiMahasiswa && $absensiMahasiswa->keterangan == 'sakit' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="sakit_{{ $mahasiswa->npm }}">Sakit</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="absensi[{{ $mahasiswa->npm }}][keterangan]" id="alpa_{{ $mahasiswa->npm }}" value="alpa" {{ $absensiMahasiswa && $absensiMahasiswa->keterangan == 'alpa' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="alpa_{{ $mahasiswa->npm }}">Alpa</label>
                            </div>
                            <input type="hidden" name="absensi[{{ $mahasiswa->npm }}][npm]" value="{{ $mahasiswa->npm }}">
                            <input type="hidden" name="absensi[{{ $mahasiswa->npm }}][pertemuan]" value="{{ $pertemuan }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection