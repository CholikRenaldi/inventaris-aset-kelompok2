<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;
use App\Models\Kategori;
class AsetController extends Controller
{public function index()
{
    $data = Aset::with('kategori')->get();
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
        'nama_barang' => 'required',
        'kategori_id' => 'required',
        'jumlah' => 'required|numeric',
        'kondisi' => 'required',
        'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $data = $request->all();

    if ($request->hasFile('foto')) {
        $file = $request->file('foto');

        $nama_file = time().'.'.$file->getClientOriginalExtension();

        // SIMPAN KE public/uploads
        $file->move(public_path('uploads'), $nama_file);

        $data['foto'] = $nama_file;
    }

    Aset::create($data);

    return redirect()->route('asets.index')
                     ->with('success', 'Data berhasil ditambahkan');
}
public function edit($id)
{
    $aset = Aset::findOrFail($id);
    $kategoris = Kategori::all();

    return view('asets.edit', compact('aset','kategoris'));
}

    public function update(Request $request, $id)
    {
 $aset = Aset::findOrFail($id);

    $request->validate([
        'kode_barang' => 'required|unique:asets,kode_barang,'.$id,
        'nama_barang' => 'required',
        'kategori_id' => 'required',
        'jumlah' => 'required|numeric',
        'kondisi' => 'required',
        'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
    ],[
        'kode_barang.unique' => 'Kode barang sudah ada!'
    ]);

    $data = $request->all();

    // ✅ Upload foto baru
    if ($request->hasFile('foto')) {

        // 🔥 Hapus foto lama (opsional tapi bagus)
        if ($aset->foto && file_exists(public_path('uploads/'.$aset->foto))) {
            unlink(public_path('uploads/'.$aset->foto));
        }

        $file = $request->file('foto');
        $nama_file = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $nama_file);

        $data['foto'] = $nama_file;
    }

    $aset->update($data);

    return redirect()->route('asets.index')
                     ->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
  $aset = Aset::findOrFail($id);

    // 🔥 Hapus foto dari folder
    if ($aset->foto && file_exists(public_path('uploads/'.$aset->foto))) {
        unlink(public_path('uploads/'.$aset->foto));
    }

    $aset->delete();

    return redirect()->route('asets.index')
                     ->with('success', 'Data berhasil dihapus');
    }
}