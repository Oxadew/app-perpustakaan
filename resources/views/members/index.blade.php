@extends('layouts.app')

@section('title', 'Daftar Member')

@section('content')
<h1>Daftar Member</h1>

<p>
    <a href="{{ route('members.create') }}" class="btn">+ Tambah Anggota</a>
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
<table>
    <thead>
        <tr>
            <th style="background: #f3f4f6;">ID</th>
            <th style="background: #f3f4f6;">Nama</th>
            <th style="background: #f3f4f6;">NIM</th>
            <th style="background: #f3f4f6;">Email</th>
            <th style="background: #f3f4f6;">No. Telepon</th>
            <th style="background: #f3f4f6;">Status</th>
            <th style="background: #f3f4f6;">Aksi</th>
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
                <td colspan="7" style="text-align: center;">Tidak ada data ditemukan.</td>
            </tr>
        @endforelse
    </tbody>
</table>

<div class="pagination-wrapper">
    {{ $members->appends(request()->query())->links() }}
</div>
@endsection