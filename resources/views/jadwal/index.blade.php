@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Jadwal</h1>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Hari</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Ruangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->hari }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $user->jam_mulai)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('H:i:s', $user->jam_selesai)->format('H:i') }}</td>
                    <td>{{ $user->ruangan }}</td>
                    <td>
                        <a href="{{ route('jadwal.show', $user->id) }}" class="btn btn-info">Lihat</a>
                        <a href="{{ route('jadwal.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection