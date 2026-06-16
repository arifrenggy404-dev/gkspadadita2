<?php

namespace App\Http\Controllers;

use App\Models\JadwalKegiatan;
use Illuminate\Http\Request;

class JadwalKegiatanController extends Controller
{
    public function index()
    {
        $jadwalKegiatans = JadwalKegiatan::all();
        return view('admin.jadwal_kegiatan.index', compact('jadwalKegiatans'));
    }

    public function create()
    {
        return view('admin.jadwal_kegiatan.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_kegiatan' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'jam' => 'required|date_format:H:i', // Perbaikan di sini
        'lokasi' => 'required|string|max:255',
        'deskripsi' => 'required|string',
    ]);

    JadwalKegiatan::create($request->all());
   // Contoh di fungsi store/update
return redirect()->route('jadwal-kegiatan.index')->with('success', 'Berhasil!');
 }
    public function edit($id)
    {
        $jadwalKegiatans = JadwalKegiatan::findOrFail($id);
        return view('admin.jadwal_kegiatan.update', compact('jadwalKegiatans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'lokasi' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ]);

        $jadwalKegiatans = JadwalKegiatan::findOrFail($id);
        $jadwalKegiatans->update($request->all());
        return redirect()->route('jadwal-kegiatan.index')->with('success', 'Jadwal Kegiatan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwalKegiatans = JadwalKegiatan::findOrFail($id);
        $jadwalKegiatans->delete();
        return redirect()->route('jadwal-kegiatan.index')->with('success', 'Jadwal Kegiatan berhasil dihapus.');
    }
}