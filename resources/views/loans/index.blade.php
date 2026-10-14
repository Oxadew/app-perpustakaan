@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
    <h1>Daftar Peminjaman</h1>

    <p><a href="{{ route('loans.create') }}" class="btn">+ Tambah Peminjaman</a></p>

    <table>
        <thead>
            <tr>
                <th style="background: #f3f4f6;">ID</th>
                <th style="background: #f3f4f6;">Anggota</th>
                <th style="background: #f3f4f6;">Petugas</th>
                <th style="background: #f3f4f6;">Buku</th>
                <th style="background: #f3f4f6;">Tgl Pinjam</th>
                <th style="background: #f3f4f6;">Tgl Kembali</th>
                <th style="background: #f3f4f6;">Status</th>
                <th style="background: #f3f4f6;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($loans as $loan)
                <tr>
                    <td>{{ $loan['id'] }}</td>
                    <td>{{ $loan['member']['nama'] }}</td>
                    <td>{{ $loan['user']['name'] }}</td>
                    <td>
                        @foreach ($loan['loanItems'] as $item)
                            {{ $item['book']['judul'] }}@if (!$loop->last), @endif
                        @endforeach
                    </td>
                    <td>{{ $loan['tanggal_pinjam'] }}</td>
                    <td>{{ $loan['tanggal_kembali'] }}</td>
                    <td><span class="badge {{ $loan['status'] === 'dikembalikan' ? 'badge-success' : ($loan['status'] === 'dipinjam' ? 'badge-warning' : 'badge-danger') }}">
    {{ ucfirst($loan['status']) }}
</span></td>
                    <td>
                        <a href="{{ route('loans.show', $loan['id']) }}">Detail</a>
                        |
                        <a href="{{ route('loans.edit', $loan['id']) }}">Edit</a>
                        |
                        <form class="inline" action="{{ route('loans.destroy', $loan['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $loans->links() }}
@endsection
