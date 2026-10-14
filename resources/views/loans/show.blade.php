@extends('layouts.app')

@section('title', 'Edit Peminjaman')

@section('content')
    <class class="form-container">
    <h1>Detail Peminjaman</h1>
    <p><a href="{{ route('loans.index') }}">&larr; Kembali ke daftar peminjaman</a></p>

    <table class="info">
        <tr>
            <th style="background: #f3f4f6;">Anggota</th>
            <td>{{ $loan['member']['nama'] }} ({{ $loan['member']['nim'] }})</td>
        </tr>
        <tr>
            <th style="background: #f3f4f6;">Petugas</th>
            <td>{{ $loan['user']['name'] }}</td>
        </tr>
        <tr>
            <th style="background: #f3f4f6;">Tanggal Pinjam</th>
            <td>{{ $loan['tanggal_pinjam'] }}</td>
        </tr>
        <tr>
            <th style="background: #f3f4f6;">Tanggal Kembali</th>
            <td>{{ $loan['tanggal_kembali'] }}</td>
        </tr>
        <tr>
            <th style="background: #f3f4f6;">Tanggal Dikembalikan</th>
            <td>{{ $loan['tanggal_dikembalikan'] ?? '-' }}</td>
        </tr>
        <tr>
            <th style="background: #f3f4f6;">Status</th>
            <td><span class="badge {{ $loan['status'] === 'dikembalikan' ? 'badge-success' : ($loan['status'] === 'dipinjam' ? 'badge-warning' : 'badge-danger') }}">
    {{ ucfirst($loan['status']) }}
</span></td>
        </tr>
    </table>

    <h2>Buku yang Dipinjam</h2>
    <table>
        <thead>
            <tr>
                <th style="background: #f3f4f6;">Judul</th>
                <th style="background: #f3f4f6;">Penulis</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($loan['loanItems'] as $item)
                <tr>
                    <td>{{ $item['book']['judul'] }}</td>
                    <td>{{ $item['book']['penulis'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
