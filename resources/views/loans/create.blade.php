@extends('layouts.app')

@section('title', 'Tambah Peminjaman')

@section('content')
<div class="form-wrapper">
    <h1>Tambah Peminjaman</h1>
    <p><a href="{{ route('loans.index') }}">&larr; Kembali ke daftar peminjaman</a></p>

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <label for="member_id">Anggota</label>
        <select name="member_id" id="member_id">
            <option value="">-- Pilih Anggota --</option>
            @foreach ($members as $member)
                <option value="{{ $member['id'] }}" @selected(old('member_id') == $member['id'])>
                    {{ $member['nama'] }} ({{ $member['nim'] }})
                </option>
            @endforeach
        </select>
        @error('member_id')
            <div class="error">{{ $message }}</div>
        @enderror

        <p style="margin-top: 12px; font-style: italic;">
            Petugas pencatat: {{ auth()->user()->name }} (otomatis dari akun yang login).
        </p>

        <label for="tanggal_pinjam">Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}">
        @error('tanggal_pinjam')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="tanggal_kembali">Tanggal Kembali</label>
        <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali') }}">
        @error('tanggal_kembali')
            <div class="error">{{ $message }}</div>
        @enderror

        <label>Buku yang Dipinjam</label>
        <div class="checkbox-container">
            @forelse ($books as $book)
                <div class="checkbox-row">
                    <input type="checkbox" name="book_ids[]" value="{{ $book['id'] }}" id="book_{{ $book['id'] }}"
                        @checked(in_array($book['id'], old('book_ids', [])))>
                    <label for="book_{{ $book['id'] }}">
                        {{ $book['judul'] }} (stok: {{ $book['stok'] }})
                    </label>
                </div>
            @empty
                <p style="margin: 0; color: #666;">Belum ada data buku.</p>
            @endforelse
        </div>
        @error('book_ids')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-submit">Simpan</button>
    </form>
</div>
@endsection