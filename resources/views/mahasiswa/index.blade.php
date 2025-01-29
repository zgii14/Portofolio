@extends("layouts.app")

@section("content")
    <section class="section">
        <div class="section-header">
            <!-- Judul Halaman -->
            <h1>
                Daftar Mahasiswa
            </h1>

            <!-- Breadcrumb -->
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Dashboard</div>
                <div class="breadcrumb-item active">
                    Profil Mahasiswa
                </div>
            </div>
        </div>
        <!-- Add New User Button -->
        @if (auth()->user()->role === "asisten")
            <div class="row mb-3">
                <div class="col-12 text-right">
                    <a href="{{ route("mahasiswa.create") }}" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Tambah mahasiswa
                    </a>

                </div>
            </div>
        @endif
        <!-- Filter dan Search Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Filter Mahasiswa</h4>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route("mahasiswa.index") }}">
                            <div class="row align-items-center">
                                <div class="col-md-4 mb-md-0 mb-3">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari nama atau NPM" value="{{ request("search") }}">
                                </div>
                                <div class="col-md-3 mb-md-0 mb-3">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                                <div class="col-md-3 mb-md-0 mb-3">
                                    <a href="{{ route("mahasiswa.index") }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Mahasiswa -->
        <div class="table-responsive">
            <table class="mt-4 table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NPM</th>
                        <th>Nomor Telepon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswas as $index => $mahasiswa)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $mahasiswa->nama }}</td>
                            <td>{{ $mahasiswa->npm }}</td>
                            <td>{{ $mahasiswa->nomor_telepon }}</td>
                            <td>
                                <a href="{{ route("mahasiswa.show", $mahasiswa->npm) }}" class="btn btn-info">Lihat</a>
                                <a href="{{ route("mahasiswa.edit", $mahasiswa->npm) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route("mahasiswa.destroy", $mahasiswa->npm) }}" method="POST"
                                    class="delete-form" style="display:inline;">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Mahasiswa tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script>
        // SweetAlert for Delete confirmation
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: 'Data yang dihapus tidak dapat dipulihkan!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
