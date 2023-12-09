<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;


class PegawaiController extends Controller
{
    public function index()
    {
        $pegawais = Pegawai::all();
        return view('pegawais.index', compact('pegawais'));
    }

    public function create()
    {
        return view('pegawais.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_nama' => 'required|max:50',
            'pegawai_umur' => 'required|integer',
            'pegawai_alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_pegawais', 'public');
            $input['foto'] = $fotoPath;
        }

        Pegawai::create($input);

        return redirect()->route('pegawais.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function show($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawais.show', compact('pegawai'));
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawais.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pegawai_nama' => 'required|max:50',
            'pegawai_umur' => 'required|integer',
            'pegawai_alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('foto_pegawais', 'public');
            $input['foto'] = $fotoPath;
        }

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($input);

        return redirect()->route('pegawais.index')->with('success', 'Pegawai berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawais.index')->with('success', 'Pegawai berhasil dihapus');
    }
}
