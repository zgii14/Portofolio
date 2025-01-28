@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>Tambah Mahasiswa</h1>
        <form action="{{ route("mahasiswa.store") }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="npm">NPM</label>
                <input type="text" name="npm" id="npm" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
