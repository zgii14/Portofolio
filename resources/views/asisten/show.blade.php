@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>Detail Mahasiswa</h1>
        <table class="table">
            <tr>
                <th>Nama</th>
                <td>{{ $asisten->nama }}</td>
            </tr>
            <tr>
                <th>NPM</th>
                <td>{{ $asisten->npm }}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $asisten->nomor_telepon }}</td>
            </tr>
        </table>
        <a href="{{ route("asisten.index") }}" class="btn btn-secondary">Kembali</a>
    </div>
@endsection
