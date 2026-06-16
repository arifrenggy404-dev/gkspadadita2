<?php

namespace App\Http\Controllers;

use App\Models\JadwalIbadah;
use Illuminate\Http\Request;

class JadwalIbadahController extends Controller
{
    public function index()
    {
        $jadwal = JadwalIbadah::all();
        return view('admin.ibadah.index', compact('jadwal'));
    }

  public function create()
{
    // Pastikan modelnya bernama Pelayanan (sesuai nama file)
    $pelayans = \App\Models\pelayanan::all(); 
    
    // Kirim dengan nama variabel yang sama
    return view('admin.ibadah.create', compact('pelayans'));
}

public function store(Request $request)
{
    $request->validate([
        'tema' => 'required|string',
        // Pastikan nama tabel di 'exists:nama_tabel,kolom' sesuai dengan yang ada di database
        // Jika tabelnya bernama 'pelayans', gunakan 'pelayans'
        'pelayan' => 'required|exists:pelayanans,nama', 
        'tanggal' => 'required|date',
        'jam' => 'required',
        'tempat' => 'required|string',
        'keterangan' => 'required|string',
    ]);

    JadwalIbadah::create($request->all());
    
    return redirect()->route('ibadah.index')->with('success', 'Data berhasil diproses.');
}
    public function edit($id)
    {
        $jadwal = JadwalIbadah::findOrFail($id);
        return view('admin.ibadah.edit', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tema' => 'required|string',
            'pelayan' => 'required|string',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'tempat' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        $jadwal = JadwalIbadah::findOrFail($id);
        $jadwal->update($request->all());
        
        // 🛠️ PERBAIKAN UTAMA: Menggunakan URL fisik langsung ke halaman utama daftar ibadah
        // Di dalam method store, update, dan destroy
return redirect()->route('ibadah.index')->with('success', 'Data berhasil diproses.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalIbadah::findOrFail($id);
        $jadwal->delete();
        
        // 🛠️ PERBAIKAN UTAMA: Menggunakan URL fisik langsung ke halaman utama daftar ibadah
        // Di dalam method store, update, dan destroy
return redirect()->route('ibadah.index')->with('success', 'Data berhasil diproses.');
}
}