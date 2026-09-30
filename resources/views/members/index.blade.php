@extends('layouts.app')

@section('title', 'Daftar Member')

@section('content')
<style>
    .search-box {
        display: flex;
        gap: 8px;
        margin-bottom: 20px;
    }
    .search-input {
        padding: 8px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        width: 280px;
    }
    .btn-search {
        padding: 8px 16px;
        background-color: #2563eb;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-reset {
        padding: 8px 16px;
        background-color: #e5e7eb;
        color: #374151;
        text-decoration: none;
        border-radius: 4px;
        display: inline-flex;
        align-items: center;
    }
    .pagination-wrapper {
        margin-top: 20px;
    }
</style>

<h1>Daftar Member</h1>

<p>
     <p><a href="{{ route('members.create') }}" class="btn">+ Tambah Anggota</a></p>
</p>

<!-- Form Pencarian Nama Anggota -->
<form action="{{ route('members.index') }}" method="GET" class="search-box">
    <input 
        type="text" 
        name="search" 
        class="search-input" 
        placeholder="Cari nama anggota..." 
        value="{{ request('search') }}"
    >
    <button type="submit" class="btn-search">Cari</button>
    @if(request('search'))
        <a href="{{ route('members.index') }}" class="btn-reset">Reset</a>
    @endif
</form>

<!-- Tabel Data Member -->
<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead>
        <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>No. Telepon</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member['id'] }}</td>
                    <td>{{ $member['nama'] }}</td>
                    <td>{{ $member['nim'] }}</td>
                    <td>{{ $member['email'] }}</td>
                    <td>{{ $member['nomor_telepon'] }}</td>
                    <td>{{ ucfirst($member['status']) }}</td>
                    <td>
                        <a href="{{ route('members.show', $member['id']) }}">Detail</a>
                        |
                        <a href="{{ route('members.edit', $member['id']) }}">Edit</a>
                        |
                        <form class="inline" action="{{ route('members.destroy', $member['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<!-- Navigasi Pagination dengan Mempertahankan Query String -->
<div class="pagination-wrapper">
    {{ $members->appends(request()->query())->links() }}
</div>
@endsection