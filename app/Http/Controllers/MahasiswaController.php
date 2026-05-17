<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = Mahasiswa::latest()->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim',
            'file_dokumen' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        $path = $request->file('file_dokumen')->store('dokumen', 's3');

        Mahasiswa::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'file_dokumen' => $path,
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data & File mahasiswa berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'file_dokumen' => 'nullable|file|mimes:jpeg,png,pdf|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'nim' => $request->nim,
        ];

        if ($request->hasFile('file_dokumen')) {
            if ($mahasiswa->file_dokumen) {
                Storage::disk('s3')->delete($mahasiswa->file_dokumen);
            }
            $data['file_dokumen'] = $request->file('file_dokumen')->store('dokumen', 's3');
        }

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->file_dokumen) {
            Storage::disk('s3')->delete($mahasiswa->file_dokumen);
        }
        
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Data dan file mahasiswa berhasil dihapus!');
    }
}
