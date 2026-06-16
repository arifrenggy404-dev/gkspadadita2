<?php

namespace App\Http\Controllers;

use App\Models\WartaMimbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema as FacadesSchema;
use Nette\Schema\Schema as NetteSchema;

class WartaMimbarController extends Controller
{
    public function index()
    {
        $wartaMimbar = WartaMimbar::orderBy('tanggal_terbit', 'desc')->get();
        return view('admin.warta_mimbar.index', compact('wartaMimbar'));
    }

    public function create()
    {
        return view('admin.warta_mimbar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'          => 'required|string|max:255',
            'isi_warta'      => 'nullable|string',
            'file'           => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'tanggal_terbit' => 'required|date',
        ]);

        $data = $request->only(['judul', 'isi_warta', 'tanggal_terbit']);

        // Simpan file ke storage/app/public/warta/
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('warta', 'public');
        }

        WartaMimbar::create($data);
        return redirect()->route('warta.index')->with('success', 'Warta Mimbar berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $wartaMimbar = WartaMimbar::findOrFail($id);
        return view('admin.warta_mimbar.update', compact('wartaMimbar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'          => 'required|string|max:255',
            'isi_warta'      => 'nullable|string',
            'file'           => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'tanggal_terbit' => 'required|date',
        ]);

        $wartaMimbar = WartaMimbar::findOrFail($id);
        $data = $request->only(['judul', 'isi_warta', 'tanggal_terbit']);

        // Hapus file jika checkbox dicentang
        if ($request->boolean('hapus_file') && $wartaMimbar->file) {
            Storage::disk('public')->delete($wartaMimbar->file);
            $data['file'] = null;
        }

        // Upload file baru — hapus file lama dulu
        if ($request->hasFile('file')) {
            if ($wartaMimbar->file) {
                Storage::disk('public')->delete($wartaMimbar->file);
            }
            $data['file'] = $request->file('file')->store('warta', 'public');
        }

        $wartaMimbar->update($data);
        return redirect()->route('warta.index')->with('success', 'Warta Mimbar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $wartaMimbar = WartaMimbar::findOrFail($id);

        // Hapus file dari storage saat data dihapus
        if ($wartaMimbar->file) {
            Storage::disk('public')->delete($wartaMimbar->file);
        }

        $wartaMimbar->delete();
        return redirect()->route('warta.index')->with('success', 'Warta Mimbar berhasil dihapus.');
    }

    public function show($id)
    {
        return redirect()->route('warta.index');
    }

    public function up(): void
{
    FacadesSchema::table('warta_mimbars', function (Blueprint $table) {
        $table->string('file')->nullable()->change();
    });
}

public function down(): void
{
    FacadesSchema::table('warta_mimbars', function (Blueprint $table) {
        $table->string('file')->nullable(false)->change();
    });
}
}