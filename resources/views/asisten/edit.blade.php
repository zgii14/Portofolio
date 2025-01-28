@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>Edit Asisten</h1>
        <form action="{{ route("asisten.update", $asisten->npm) }}" method="POST">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="{{ $asisten->nama }}" required>
            </div>
            <div class="form-group">
                <label for="npm">NPM</label>
                <input type="text" name="npm" id="npm" class="form-control" value="{{ $asisten->npm }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon</label>
                <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control"
                    value="{{ $asisten->nomor_telepon }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route("asisten.index") }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
