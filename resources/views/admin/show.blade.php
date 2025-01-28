@extends("layouts.app")

@section("content")
    <section class="section">
        <div class="section-header">
            <h1>Detail Pengguna</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route("admin.users.index") }}">Pengguna</a></div>
                <div class="breadcrumb-item active">{{ $user->name }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{ $user->name }}</h4>
                        </div>
                        <div class="card-body">
                            <!-- Detail Pengguna -->
                            <p><strong>Nama:</strong> {{ $user->name }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Nomor HP:</strong> {{ $user->phone ?? "-" }}</p>
                            <p><strong>Role:</strong>
                                @if ($user->role === "admin")
                                    <span class="badge badge-danger">{{ ucwords(strtolower($user->role)) }}</span>
                                @elseif ($user->role === "asisten")
                                    <span class="badge badge-primary">{{ ucwords(strtolower($user->role)) }}</span>
                                @endif
                            </p>

                            <a href="{{ route("admin.users.index") }}" class="btn btn-secondary mt-4">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Teams Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Tim</h4>
                        </div>
                        <div class="card-body">

                            @if ($user->mahasiswas->isEmpty())
                                <p class="text-muted">Pengguna ini belum memiliki mahasiswa.</p>
                            @else
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <thead>
                                            <tr>
                                                <th>Nama Mahasiswa</th>
                                                <th>NPM</th>
                                                <th>Nomor Telepon</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->mahasiswas as $mahasiswa)
                                                <tr>
                                                    <td>{{ $mahasiswa->nama }}</td>
                                                    <td>{{ $mahasiswa->npm }}</td>
                                                    <td>{{ $mahasiswa->nomor_telepon }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
