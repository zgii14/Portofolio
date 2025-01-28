@extends("layouts.app")

@section("content")
    <section class="section">
        <div class="section-header">
            <!-- Judul Halaman -->
            <h1>
                Daftar Asisten
            </h1>

            <!-- Breadcrumb -->
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">Dashboard</div>
                <div class="breadcrumb-item active">
                    Profil Asisten
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 text-right">
                <a href="{{ route("asisten.create") }}" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Tambah Asisten
                </a>

            </div>
        </div>

        <!-- Tabel Asisten -->
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
                    @foreach ($asistens as $index => $asisten)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $asisten->nama }}</td>
                            <td>{{ $asisten->npm }}</td>
                            <td>{{ $asisten->nomor_telepon }}</td>
                            <td>
                                <a href="{{ route("asisten.show", $asisten->npm) }}" class="btn btn-info">Lihat</a>
                                <a href="{{ route("asisten.edit", $asisten->npm) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route("asisten.destroy", $asisten->npm) }}" method="POST"
                                    class="delete-form" style="display:inline;">
                                    @csrf
                                    @method("DELETE")
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
