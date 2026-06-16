<?php

namespace App\Http\Controllers;

use App\Models\DataJemaat; // Menggunakan Model DataJemaat sesuai file Anda
use App\Models\Jemaat;
use Illuminate\Http\Request;

class JemaatController extends Controller
{
   public function index(Request $request)
{
    // Mengambil data jemaat, jika ada input 'search', maka difilter
    $jemaat = \App\Models\Jemaat::when($request->search, function($query) use ($request) {
        $query->where('nama_jemaat', 'like', '%' . $request->search . '%');
    })->get();


        return view('admin.jemaat.index', compact('jemaat'));
    }

    public function create()
    {
        // Mengarah ke halaman form tambah (jika nanti Anda buat file create.blade.php)
        return view('admin.jemaat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jemaat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
            'status' => 'required|string',
        ]);

        Jemaat::create($request->all());
        
        // Menggunakan redirect URL fisik '/jemaat' agar lebih aman dan tidak mementingkan nama route
        return redirect()->to('/jemaat')->with('success', 'Data Jemaat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jemaat = Jemaat::findOrFail($id);
        
        // Mengarah ke halaman form edit (jika nanti Anda buat file edit.blade.php)
        return view('admin.jemaat.update', compact('jemaat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jemaat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:15',
            'status' => 'required|string',
        ]);

        $jemaat = Jemaat::findOrFail($id);
        $jemaat->update($request->all());
        
        return redirect()->to('/jemaat')->with('success', 'Data Jemaat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jemaat = Jemaat::findOrFail($id);
        $jemaat->delete();
        
        return redirect()->to('/jemaat')->with('success', 'Data Jemaat berhasil dihapus.');
    }
}