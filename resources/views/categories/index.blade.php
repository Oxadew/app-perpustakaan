{{-- File: resources/views/categories/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
    <h1>Daftar Kategori</h1>

    <p><a href="{{ route('categories.create') }}" class="btn">+ Tambah Kategori</a></p>

    <table>
        <thead>
            <tr>
                <th style="background: #f3f4f6;">ID</th>
                <th style="background: #f3f4f6;">Nama Kategori</th>
                <th style="background: #f3f4f6;">Deskripsi</th>
                <th style="background: #f3f4f6;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category['id'] }}</td>
                    <td>{{ $category['nama_kategori'] }}</td>
                    <td>{{ $category['deskripsi'] ?? '-' }}</td>
                    <td>

                        <a href="{{ route('categories.edit', $category['id']) }}">Edit</a>
                        |
                        <form class="inline" action="{{ route('categories.destroy', $category['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada data kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $categories->links() }}
@endsection