@extends('layouts.app')

@section('title', 'Tambah Member')

@section('content')
<h1>Tambah Member</h1>
<p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar member</a></p>

<form action="{{ route('members.store') }}" method="POST" class="form-container">
    @csrf

    <div class="form-group">
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" value="{{ old('nama') }}">
        @error('nama')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="nim">NIM</label>
        <input type="number" name="nim" id="nim" value="{{ old('nim') }}">
        @error('nim')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}">
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="nomor_telepon">Nomor Telepon</label>
        <input type="tel" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}">
        @error('nomor_telepon')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}">
        @error('alamat')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="aktif" @selected(old('status') == 'aktif')>Aktif</option>
            <option value="nonaktif" @selected(old('status') == 'nonaktif')>Nonaktif</option>
        </select>
        @error('status')
            <div class="error">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn">Simpan</button>
</form>
@endsection