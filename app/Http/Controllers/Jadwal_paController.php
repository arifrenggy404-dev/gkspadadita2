<?php

namespace App\Http\Controllers;

use App\Models\jadwal_pa;
use Illuminate\Http\Request;

class Jadwal_paController extends Controller
{
    public function index () {
        $jadwalpas = jadwal_pa::all();
        return view('admin.jadwal_pa.index', compact('jadwalpas'));
    }

     public function edit($id)
    {
        $jadwalpas= jadwal_pa::findOrFail($id);
        return view('admin.jadwal_pa.update', compact('jadwalpas'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'pelayan' => 'required|string',
            'ayat_bacaan' => 'required',
            'lokasi' => 'required|string',
            'pendamping' => 'required|string',
            'jam' => 'required|date_format:H:i',
            'tanggal' => 'required|date',
        ]);

        $jadwalpas = jadwal_pa::findOrFail($id);
        $jadwalpas->update($request->all());
        
        // 🛠️ PERBAIKAN UTAMA: Menggunakan URL fisik langsung ke halaman utama daftar ibadah
        return redirect('/jadwal_pa')->with('success', 'Jadwal Ibadah berhasil diperbarui.');
    }

   public function create()
{
    // Ambil data dari database
    $jemaat = \App\Models\Jemaat::all();
    
    $pelayanans = \App\Models\pelayanan::all(); // Tambahkan baris ini

    // Kirim data ke view
    return view('admin.jadwal_pa.create', compact('jemaat', 'pelayanans'));
}

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'pelayan' => 'required|string',
            'ayat_bacaan' => 'required',
            'lokasi' => 'required|string',
            'pendamping' => 'required|string',
            'jam' => 'required|date_format:H:i', 
            'tanggal' => 'required|date',
        ]);

        jadwal_pa::create($request->all());
        return redirect('/jadwal_pa')->with('success', 'Jadwal Ibadah berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $jadwalpas = jadwal_pa::findOrFail($id);
        $jadwalpas->delete();
        
        // 🛠️ PERBAIKAN UTAMA: Menggunakan URL fisik langsung ke halaman utama daftar ibadah
        return redirect('/jadwal_pa')->with('success', 'Jadwal Ibadah berhasil dihapus.');
    }


}
