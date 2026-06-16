<?php



namespace App\Http\Controllers;



use App\Models\PendaftaranKatekesasi;

use Illuminate\Http\Request;



class PendaftaranKatekesasiController extends Controller

{

    // Menampilkan daftar jemaat yang mendaftar katekesasi

    public function index()

    {

        $pendaftarans = PendaftaranKatekesasi::all();

        return view('admin.pendaftaran_katekesasi.index', compact('pendaftarans'));

    }
    // Menampilkan detail biodata pendaftar tertentu jika diklik

     public function edit($id)

    {
        $pendaftarans= PendaftaranKatekesasi::findOrFail($id);

        return view('admin.pendaftaran_katekesasi.update', compact('pendaftarans'));
    }
    public function update(Request $request, $id)

    {

        $request->validate([

            'nama_lengkap' => 'required|string',

            'katekesasi' => 'required|string',

            'jenis_kelamin' => 'required|string',

            'tempat_lahir' => 'required|string',

            'tanggal_lahir' => 'required|date',

            'nama_ayah' => 'required|string',

            'nama_ibu' => 'required|string',

            'telepon' => 'required|string',

            

        ]);



        $pendaftarans = PendaftaranKatekesasi::findOrFail($id);

        $pendaftarans->update($request->all());

       

        // 🛠️ PERBAIKAN UTAMA: Menggunakan URL fisik langsung ke halaman utama daftar ibadah

        return redirect('/pendaftaran_katekesasi')->with('success', 'Jadwal Ibadah berhasil diperbarui.');

    }



    public function create()

    {

        return view('admin.pendaftaran_katekesasi.create');

    }



    public function store(Request $request)

    {

        $request->validate([

            'nama_lengkap' => 'required|string',

            'katekesasi' => 'required|string',

            'jenis_kelamin' => 'required|string',

            'tempat_lahir' => 'required|string',

            'tanggal_lahir' => 'required|date',

            'nama_ayah' => 'required|string',

            'nama_ibu' => 'required|string',

            'telepon' => 'required|string',

           
        ]);



        PendaftaranKatekesasi::create($request->all());

        return redirect('/pendaftaran_katekesasi')->with('success', 'Jadwal Ibadah berhasil ditambahkan.');

    }



    public function destroy($id)

    {

        $pendaftarans = PendaftaranKatekesasi::findOrFail($id);

        $pendaftarans->delete();

       

        // 🛠️ PERBAIKAN UTAMA: Menggunakan URL fisik langsung ke halaman utama daftar ibadah

        return redirect('/pendaftaran_katekesasi')->with('success', 'Jadwal Ibadah berhasil dihapus.');
    }

    // Tambahkan method ini untuk form publik
public function simpanPendaftaran(Request $request)
{
    $request->validate([
        'nama_lengkap'  => 'required|string',
        'katekesasi'    => 'required|string|in:Baptis,Sidi,Nikah',
        'jenis_kelamin' => 'required|string|in:L,P',
        'tempat_lahir'  => 'required|string',
        'tanggal_lahir' => 'required|date',
        'nama_ayah'     => 'required|string',
        'nama_ibu'      => 'required|string',
        'telepon'       => 'required|string',
    ]);

    PendaftaranKatekesasi::create($request->only([
        'nama_lengkap', 'katekesasi', 'jenis_kelamin',
        'tempat_lahir', 'tanggal_lahir', 'nama_ayah', 'nama_ibu', 'telepon',
    ]));

    return redirect()->back()->with('success', 'Pendaftaran berhasil dikirim! Panitia akan menghubungi Anda.');
}





}