<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AbsensiMahasiswa;
use App\Models\Mahasiswa;

use PDF;
class AbsensiMahasiswaController extends Controller
{
    public function index(Request $request)
    {
        $pertemuan = $request->get('pertemuan', 1); // Default ke pertemuan 1 jika tidak ada parameter
        $mahasiswas = Mahasiswa::all();
        $absensi = AbsensiMahasiswa::where('pertemuan', $pertemuan)->get();
        return view('absensi.index', compact('mahasiswas', 'absensi', 'pertemuan'));
    }

    public function create()
    {
        $mahasiswas = Mahasiswa::all();
        return view('absensi.create', compact('mahasiswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'absensi.*.npm' => 'required|exists:mahasiswas,npm',
            'absensi.*.keterangan' => 'required|in:hadir,izin,sakit,alpa',
            'absensi.*.pertemuan' => 'required|integer|min:1|max:8',
        ]);

        foreach ($request->absensi as $npm => $data) {
            AbsensiMahasiswa::updateOrCreate(
                ['npm' => $data['npm'], 'pertemuan' => $data['pertemuan']],
                ['keterangan' => $data['keterangan']]
            );
        }

        // Tambahkan flash message sukses
        return redirect()->route('absensi.index', ['pertemuan' => $request->pertemuan])
                         ->with('success', 'Data absensi berhasil disimpan.');
    }

    public function edit(AbsensiMahasiswa $absensi)
    {
        $mahasiswas = Mahasiswa::all();
        return view('absensi.edit', compact('absensi', 'mahasiswas'));
    }

    public function update(Request $request, AbsensiMahasiswa $absensi)
    {
        $request->validate([
            'npm' => 'required|exists:mahasiswas,npm',
            'keterangan' => 'required|in:hadir,izin,sakit,alpa',
            'pertemuan' => 'required|integer|min:1|max:8',
        ]);

        $absensi->update($request->all());

        // Tambahkan flash message sukses
        return redirect()->route('absensi.index')
                         ->with('success', 'Data absensi berhasil diperbarui.');
    }

    public function destroy(AbsensiMahasiswa $absensi)
    {
        $absensi->delete();

        // Tambahkan flash message sukses
        return redirect()->route('absensi.index')
                         ->with('success', 'Data absensi berhasil dihapus.');
    }
    public function rekap()
    {
        $mahasiswas = Mahasiswa::all();
        $rekap = [];

        foreach ($mahasiswas as $mahasiswa) {
            $absensi = AbsensiMahasiswa::where('npm', $mahasiswa->npm)->get();
            $hadir = $absensi->where('keterangan', 'hadir')->count();
            $izin = $absensi->where('keterangan', 'izin')->count();
            $sakit = $absensi->where('keterangan', 'sakit')->count();
            $alpa = $absensi->where('keterangan', 'alpa')->count();
            $totalPertemuan = $hadir + $izin + $sakit + $alpa;
            $point = $hadir * 1 + $izin * 0.5 + $sakit * 0.5;
            $presentase = ($totalPertemuan > 0) ? ($point / $totalPertemuan) * 100 : 0;

            $rekap[] = [
                'nama' => $mahasiswa->nama,
                'npm' => $mahasiswa->npm,
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit,
                'alpa' => $alpa,
                'point' => $point,
                'presentase' => $presentase,
            ];
        }

        return view('absensi.rekap', compact('rekap'));
    }
    public function cetakPDF()
    {
        $mahasiswas = Mahasiswa::all();
        $rekap = [];

        foreach ($mahasiswas as $mahasiswa) {
            $absensi = AbsensiMahasiswa::where('npm', $mahasiswa->npm)->get();
            $hadir = $absensi->where('keterangan', 'hadir')->count();
            $izin = $absensi->where('keterangan', 'izin')->count();
            $sakit = $absensi->where('keterangan', 'sakit')->count();
            $alpa = $absensi->where('keterangan', 'alpa')->count();
            $totalPertemuan = $hadir + $izin + $sakit + $alpa;
            $point = $hadir * 1 + $izin * 0.5 + $sakit * 0.5;
            $presentase = ($totalPertemuan > 0) ? ($point / $totalPertemuan) * 100 : 0;

            $rekap[] = [
                'nama' => $mahasiswa->nama,
                'npm' => $mahasiswa->npm,
                'hadir' => $hadir,
                'izin' => $izin,
                'sakit' => $sakit,
                'alpa' => $alpa,
                'point' => $point,
                'presentase' => $presentase,
            ];
        }

        $pdf = PDF::loadView('absensi.rekap_pdf', compact('rekap'))->setPaper('a4', 'landscape');

        return $pdf->stream('rekap_absensi.pdf');
    }
}