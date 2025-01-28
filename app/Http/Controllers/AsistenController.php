<?php
namespace App\Http\Controllers;

use App\Models\Asisten;
use Illuminate\Http\Request;

class AsistenController extends Controller
{
    public function index()
    {
        $asistens = Asisten::where('user_id', auth()->id())->get();
        return view('asisten.index', compact('asistens'));
    }

    public function create()
    {
        return view('asisten.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'npm' => 'required|string|max:255|unique:asistens',
            'nomor_telepon' => 'required|string|max:255',
        ]);

        $validated['user_id'] = auth()->id(); // Tambahkan user_id dari pengguna yang sedang login

        Asisten::create($validated);

        return redirect()->route('asisten.index')->with('success', 'Asisten berhasil dibuat.');
    }

    public function show(Asisten $asisten)
    {
        return view('asisten.show', compact('asisten'));
    }

    public function edit(Asisten $asisten)
    {
        return view('asisten.edit', compact('asisten'));
    }

    public function update(Request $request, Asisten $asisten)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:255',
        ]);

        $asisten->update($validated);

        return redirect()->route('asisten.index')->with('success', 'Asisten berhasil diperbarui.');
    }

    public function destroy(Asisten $asisten)
    {
        $asisten->delete();

        return redirect()->route('asisten.index')->with('success', 'Asisten berhasil dihapus.');
    }
}