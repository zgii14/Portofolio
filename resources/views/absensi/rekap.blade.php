@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rekap Absensi Mahasiswa</h1>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Mahasiswa</th>
                <th>NPM</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Sakit</th>
                <th>Alpa</th>
                <th>Point</th>
                <th>Presentase (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data['nama'] }}</td>
                    <td>{{ $data['npm'] }}</td>
                    <td>{{ $data['hadir'] }}</td>
                    <td>{{ $data['izin'] }}</td>
                    <td>{{ $data['sakit'] }}</td>
                    <td>{{ $data['alpa'] }}</td>
                    <td>{{ $data['point'] }}</td>
                    <td>{{ number_format($data['presentase'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ url('/absensi') }}" class="btn btn-secondary">Kembali</a>
    <a href="{{ route('absensi.cetak') }}" class="btn btn-primary">Cetak PDF</a>

</div>
@endsection