@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
    <div class="form-container">
        <h1>Edit Peminjaman</h1>
        <p><a href="{{ route('loans.index') }}">&larr; Kembali ke daftar peminjaman</a></p>

        <div class="form-group">
            <label>Anggota</label>
            <div class="readonly">{{ $loan['member']['nama'] }} ({{ $loan['member']['nim'] }})</div>
        </div>

        <div class="form-group">
            <label>Buku</label>
            <div class="readonly">
                @foreach ($loan['loanItems'] as $item)
                    {{ $item['book']['judul'] }}@if (!$loop->last), @endif
                @endforeach
            </div>
        </div>

        <form action="{{ route('loans.update', $loan['id']) }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="tanggal_pinjam" value="{{ $loan['tanggal_pinjam'] }}">

            <div class="form-group">
                <label for="tanggal_kembali">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali', $loan['tanggal_kembali']) }}">
                @error('tanggal_kembali')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="dipinjam" @selected(old('status', $loan['status']) == 'dipinjam')>Dipinjam</option>
                    <option value="terlambat" @selected(old('status', $loan['status']) == 'terlambat')>Terlambat</option>
                </select>
                @error('status')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn">Perbarui</button>
        </form>

        <div class="actions" style="margin-top: 15px;">
            @if ($loan['status'] === 'dipinjam')
                <form action="{{ route('loans.kembalikan', $loan['id']) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn" style="background-color: #059669;" onclick="return confirm('Apakah Anda yakin ingin mengembalikan buku sekarang?')">
                        Kembalikan Buku
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection