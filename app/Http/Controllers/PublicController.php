<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ibadah;
use App\Models\jadwal_pa;
use App\Models\JadwalIbadah;
use App\Models\JadwalKegiatan;
use App\Models\JadwalPa;
use App\Models\WartaMimbar;
use App\Models\PendaftaranKatekesasi;

class PublicController extends Controller
{
    /**
     * Halaman Beranda
     */
    public function beranda()
    {
        // Ambil jadwal ibadah mendatang (3 terdekat)
        $jadwalIbadah = JadwalIbadah::where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->take(3)
            ->get();

        // Ambil warta mimbar terbaru (3 terbaru)
        $wartaTerbaru = WartaMimbar::orderBy('tanggal_terbit', 'desc')
            ->take(3)
            ->get();

        // Ambil kegiatan mendatang (3 terdekat)
        $kegiatanMendatang = JadwalKegiatan::where('tanggal', '>=', now()->toDateString())
            ->orderBy('tanggal', 'asc')
            ->take(3)
            ->get();

        return view('public.beranda', compact(
            'jadwalIbadah',
            'wartaTerbaru',
            'kegiatanMendatang'
        ));
    }

    /**
     * Halaman Jadwal Ibadah
     */
    public function jadwalIbadah()
    {
        $jadwalIbadah = JadwalIbadah::orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->paginate(10);

        return view('user.jadwal_ibadah', compact('jadwalIbadah'));
    }

    /**
     * Halaman Jadwal PA
     */
    public function jadwalPa()
    {
        $jadwalPa = jadwal_pa::orderBy('tanggal', 'asc')
            ->orderBy('jam', 'asc')
            ->paginate(10);

        return view('user.jadwal-pa', compact('jadwalPa'));
    }

    /**
     * Halaman Jadwal Kegiatan
     */
    public function jadwalKegiatan()
    {
        $jadwalKegiatan = JadwalKegiatan::orderBy('tanggal', 'asc')
            ->paginate(10);

        return view('user.kegiatan', compact('jadwalKegiatan'));
    }

    /**
     * Halaman Warta Mimbar
     */
    public function wartaMimbar()
    {
        $wartaMimbar = WartaMimbar::orderBy('tanggal_terbit', 'desc')
            ->paginate(10);

        return view('user.warta-mimbar', compact('wartaMimbar'));
    }

    /**
     * Detail Warta Mimbar
     */
    public function wartaDetail($id)
    {
        $warta = WartaMimbar::findOrFail($id);

        // Warta lainnya (selain yang sedang dibuka)
        $wartaLainnya = WartaMimbar::where('id_warta', '!=', $id)
            ->orderBy('tanggal_terbit', 'desc')
            ->take(3)
            ->get();

        return view('user.warta-mimbar', compact('warta', 'wartaLainnya'));
    }

    /**
     * Halaman Pendaftaran Katekesasi
     */
    public function pendaftaranKatekesasi()
    {
        return view('user.pendaftaran-katekesasi');
    }

    /**
     * Simpan Pendaftaran Katekesasi
     */
    public function simpanPendaftaran(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap'    => 'required|string|max:255',
            'tempat_lahir'    => 'required|string|max:255',
            'tanggal_lahir'   => 'required|date',
            'jenis_kelamin'   => 'required|in:L,P',
            'alamat'          => 'required|string',
            'telepon'      => 'required|string|max:20',
            'nama_ayah' => 'required|string',

            'nama_ibu' => 'required|string',
            'keterangan'      => 'nullable|string',
        ], [
            'nama_lengkap.required'   => 'Nama lengkap wajib diisi.',
            'tempat_lahir.required'   => 'Tempat lahir wajib diisi.',
            'tanggal_lahir.required'  => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required'  => 'Jenis kelamin wajib dipilih.',
            'alamat.required'         => 'Alamat wajib diisi.',
            'telepon.required'     => 'Nomor telepon wajib diisi.',
            'nama_ayah.required' => 'Nama orang tua wajib diisi.',
            'nama_ibu.required' => 'Nama orang tua wajib diisi.',
        ]);

        PendaftaranKatekesasi::create($validated);

           return redirect()->route('user.pendaftaran-katekesasi')->with('success', 'Pendaftaran berhasil dikirim! Kami akan menghubungi Anda segera.'); }
}