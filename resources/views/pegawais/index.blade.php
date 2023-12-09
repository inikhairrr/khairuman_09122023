<!-- resources/views/pegawais/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Daftar Pegawai</h2>
    <a href="{{ route('pegawais.create') }}" class="btn btn-primary">Tambah Pegawai</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pegawais as $pegawai)
                <tr>
                    <td>{{ $pegawai->pegawai_id }}</td>
                    <td>{{ $pegawai->pegawai_nama }}</td>
                    <td>{{ $pegawai->pegawai_umur }}</td>
                    <td>{{ $pegawai->pegawai_alamat }}</td>
                    <td>
                        @if ($pegawai->foto)
                            <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto" style="max-width: 100px;">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('pegawais.show', $pegawai->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('pegawais.edit', $pegawai->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('pegawais.destroy', $pegawai->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pegawai ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
