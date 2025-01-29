<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class JadwalController extends Controller
{
    public function index()
    {
        $users = User::whereNotNull('hari')
            ->whereNotNull('jam_mulai')
            ->whereNotNull('jam_selesai')
            ->whereNotNull('ruangan')
            ->get();

        return view('jadwal.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('jadwal.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('jadwal.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'hari' => 'required|string',
            'jam_mulai' => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'ruangan' => 'required|string',
        ]);

        // Validasi jam praktikum hanya bisa dari jam 7.30 sampai 16.00
        $jamMulai = strtotime($request->jam_mulai);
        $jamSelesai = strtotime($request->jam_selesai);
        $jamMulaiBatas = strtotime('07:30');
        $jamSelesaiBatas = strtotime('16:00');

        if ($jamMulai < $jamMulaiBatas || $jamSelesai > $jamSelesaiBatas) {
            return back()->withErrors(['jam' => 'Jam praktikum hanya bisa dari jam 07:30 sampai 16:00.']);
        }

        // Validasi jadwal tidak bertabrakan
        $conflict = User::where('hari', $request->hari)
            ->where('ruangan', $request->ruangan)
            ->where('id', '!=', $user->id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                      ->orWhere(function ($query) use ($request) {
                          $query->where('jam_mulai', '<=', $request->jam_mulai)
                                ->where('jam_selesai', '>=', $request->jam_selesai);
                      });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['conflict' => 'Jadwal bertabrakan dengan jadwal lain di ruangan yang sama.']);
        }

        $user->update($request->all());

        return redirect()->route('jadwal.index');
    }
}