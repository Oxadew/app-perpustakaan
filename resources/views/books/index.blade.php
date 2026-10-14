{{-- File: resources/views/books/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <h1>Daftar Buku</h1>

    <p><a href="{{ route('books.create') }}" class="btn">+ Tambah Buku</a></p>

    <table>
        <thead>
            <tr>
                <th style="background: #f3f4f6;">ID</th>
                <th style="background: #f3f4f6;">Judul</th>
                <th style="background: #f3f4f6;">Penulis</th>
                <th style="background: #f3f4f6;">Penerbit</th>
                <th style="background: #f3f4f6;">Tahun</th>
                <th style="background: #f3f4f6;">Stok</th>
                <th style="background: #f3f4f6;">Kategori</th>
                <th style="background: #f3f4f6;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $book['id'] }}</td>
                    <td>{{ $book['judul'] }}</td>
                    <td>{{ $book['penulis'] }}</td>
                    <td>{{ $book['penerbit'] }}</td>
                    <td>{{ $book['tahun_terbit'] }}</td>
                    <td>{{ $book['stok'] }}</td>
                    <td>{{ $book['category']['nama_kategori'] }}</td>
                    <td>
                        <a href="{{ route('books.show', $book['id']) }}">Detail</a>
                        |
                        <a href="{{ route('books.edit', $book['id']) }}">Edit</a>
                        |
                        <form class="inline" action="{{ route('books.destroy', $book['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada data buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $books->links() }}
@endsection