<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $data = Aset::with('kategori')
            ->when($search, function ($query) use ($search) {
                $query->where('nama_barang', 'like', '%' . $search . '%')
                      ->orWhere('kode_barang', 'like', '%' . $search . '%');
            })
            ->paginate(5);

        return view('asets.index', compact('data'));
    }

    public function create()
    {
        $kategoris = Kategori::all();

        return view('asets.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|unique:asets',
            'nama_barang' => 'required|min:3',
            'kategori_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'kondisi' => 'required',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'kode_barang.required' => 'Kode barang wajib diisi',
            'kode_barang.unique' => 'Kode barang sudah ada',

            'nama_barang.required' => 'Nama barang wajib diisi',
            'nama_barang.min' => 'Nama barang minimal 3 karakter',

            'kategori_id.required' => 'Kategori wajib dipilih',

            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 1',

            'kondisi.required' => 'Kondisi wajib dipilih',

            'foto.required' => 'Foto wajib diupload',
            'foto.image' => 'File harus berupa gambar',
            'foto.mimes' => 'Format foto harus JPG/JPEG/PNG',
            'foto.max' => 'Ukuran foto maksimal 2MB'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');

            $nama_file = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $nama_file);

            $data['foto'] = $nama_file;
        }

        Aset::create($data);

        return redirect()
            ->route('asets.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $aset = Aset::findOrFail($id);

        $kategoris = Kategori::all();

        return view('asets.edit', compact('aset', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $aset = Aset::findOrFail($id);

        $request->validate([
            'kode_barang' => 'required|unique:asets,kode_barang,' . $id,
            'nama_barang' => 'required|min:3',
            'kategori_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
            'kondisi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'kode_barang.required' => 'Kode barang wajib diisi',
            'kode_barang.unique' => 'Kode barang sudah ada',

            'nama_barang.required' => 'Nama barang wajib diisi',

            'kategori_id.required' => 'Kategori wajib dipilih',

            'jumlah.required' => 'Jumlah wajib diisi',
            'jumlah.numeric' => 'Jumlah harus angka',

            'foto.image' => 'File harus berupa gambar'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {

            if ($aset->foto && file_exists(public_path('uploads/' . $aset->foto))) {
                unlink(public_path('uploads/' . $aset->foto));
            }

            $file = $request->file('foto');

            $nama_file = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads'), $nama_file);

            $data['foto'] = $nama_file;
        }

        $aset->update($data);

        return redirect()
            ->route('asets.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);

        if ($aset->foto && file_exists(public_path('uploads/' . $aset->foto))) {
            unlink(public_path('uploads/' . $aset->foto));
        }

        $aset->delete();

        return redirect()
            ->route('asets.index')
            ->with('success', 'Data berhasil dihapus');
    }

    public function pdf()
    {
        $data = Aset::with('kategori')->get();

        $pdf = Pdf::loadView('asets.laporan_pdf', compact('data'));

        return $pdf->download('laporan_aset.pdf');
    }
}