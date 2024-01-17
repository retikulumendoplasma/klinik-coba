<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\berita;
use Illuminate\Validation\Rule;
use illuminate\Support\Facades\Gate;

class BeritaController extends Controller
{
    //controller untuk menampilkan tampilan pada halaman berita
    public function index()
    {
        return view('berita', [
            //pengisian berita
            "title" => "berita",
            //data berita sudah tersimpan dalam models berita
            "berita" => berita::all()
        ]);
    }

    public function home()
    {
        return view('home', [
            "title" => "Home",
            //data berita sudah tersimpan dalam models berita
            "berita" => berita::all()
        ]);
    }

    //controller untuk mengontrol slug tampilan detailberita
    public function tampil($id)
    {
        return view('detailberita', [
            "title" => "Detail Berita",
            //data berita sudah tersimpan dalam models berita
            "detailberita" => Berita::find($id)
        ]);
    }

    //controller untuk menampilkan berita terbuat pada halaman kelola berita
    public function data()
    {
        return view('dashBoard.kelolaBerita', [
            //pengisian berita
            "title" => "Kelola Berita",
            //data berita sudah tersimpan dalam models berita
            "kelolaberita" => berita::paginate(10)
        ]);
    }

    //controller untuk mengontrol tampilan viewBerita
    public function lihat(berita $berita)
    {
        return view('/dashBoard.viewBerita', [
            "title" => "Lihat Berita",
            //data berita sudah tersimpan dalam models berita
            "viewberita" => $berita
        ]);
    }

    public function destroy($id)
    {
        // Cari berita berdasarkan ID
        $berita = berita::find($id);

        // Hapus berita jika ditemukan
        if ($berita) {
            $berita->delete();
            return redirect('/kelolaBerita')->with('success', 'Berita berhasil dihapus.');
        } else {
            return redirect('/kelolaBerita')->with('error', 'Berita tidak ditemukan.');
    }
    }

    public function create()
    {
        return view('dashBoard.tambahB', [
            //pengisian berita
            "title" => "Tambah berita"
        ]);
    }

    public function store(Request $request)
    {
        // dd('Metode Store diakses');
        $validatedData = $request->validate([
            'judul_berita' => 'required|max:100',
            'isi_berita' => 'required',
            'img' => 'image|file',
        ]);
        $validatedData['excerpt'] = Str::limit(strip_tags($request->isi_berita), 200);
        $validatedData['tgl_terbit'] = $request->input('tgl_terbit', now());
        $validatedData['img'] = $request->file('img')->store('gambar-berita');
        // dd($request->all());
        berita::create($validatedData);


        return redirect('/kelolaBerita')->with('success', 'Tambah Berita Berhasil');
    }

    public function edit(berita $berita)
    {
        return view('dashBoard.editBerita', [
            "title" => "Edit Berita",
            "berita" => $berita,
            //data berita sudah tersimpan dalam models berita
            "kelolaberita" => berita::all()
        ]);
    }

    public function update(Request $request, berita $berita)
    {
        // dd('Metode Store diakses');
        $validatedData = $request->validate([
            'judul_berita' => 'required|max:100',
            'isi_berita' => 'required',
        ]);

        $validatedData['excerpt'] = Str::limit(strip_tags($request->isi_berita), 200);
        $validatedData['tgl_terbit'] = $request->input('tgl_terbit', now());
        if ($request->hasFile('img')) {
            $validatedData['img'] = $request->file('img')->store('gambar-berita');
        }
        berita::where('id', $berita->id)->update($validatedData);

        return redirect('/kelolaBerita')->with('success', 'Edit Berita Berhasil');
    }

}
