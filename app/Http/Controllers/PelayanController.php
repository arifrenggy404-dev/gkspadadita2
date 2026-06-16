<?php

namespace App\Http\Controllers;

use App\Models\pelayanan;
use Illuminate\Http\Request;

class PelayanController extends Controller
{
     public function index(Request $request)
{
    // Mengambil data jemaat, jika ada input 'search', maka difilter
    $Pelayan =pelayanan::when($request->search, function($query) use ($request) {
        $query->where('nama', 'like', '%' . $request->search . '%');
    })->get();


        return view('admin.pelayan.index', compact('Pelayan'));
    }

    public function create()
    {
        // Mengarah ke halaman form tambah (jika nanti Anda buat file create.blade.php)
        return view('admin.pelayan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|string',
            'nomor_tlpn' => 'required|string|max:15',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
        ]);

        pelayanan::create($request->all());
        
        // Menggunakan redirect URL fisik '/jemaat' agar lebih aman dan tidak mementingkan nama route
        return redirect()->to('/pelayan')->with('success', 'Data Pelayan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $Pelayan = pelayanan::findOrFail($id);
        
        // Mengarah ke halaman form edit (jika nanti Anda buat file edit.blade.php)
        return view('admin.pelayan.update', compact('Pelayan'));
    }

    public function update(Request $request, $id)
    {
       $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|string',
            'nomor_tlpn' => 'required|string|max:15',
            'jenis_kelamin' => 'required|string',
            'alamat' => 'required|string',
        ]);

        $Pelayan = pelayanan::findOrFail($id);
        $Pelayan->update($request->all());
        
        return redirect()->to('/pelayan')->with('success', 'Data Pelayan berhasil diperbarui.');
    }

    public function destroy($id)
{
    $Pelayan = pelayanan::findOrFail($id);
    $Pelayan->delete(); // Ganti $Pelayan->Pelayan() menjadi ini
    return redirect()->route('pelayan.index')->with('success', 'Data berhasil dihapus.');
}
}
