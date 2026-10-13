@extends('layouts.app')

@section('content')
<div class="container py-4" style="max-width: 700px; margin: 0 auto;">
    
    {{-- Notifikasi Sukses --}}
    @if(session('success'))
        <div class="alert alert-success" style="padding: 10px; background: #d4edda; color: #155724; border-radius: 5px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Kartu Profil Petugas --}}
    <div style="background: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); margin-bottom: 25px; overflow: hidden;">
        <div style="background: #f8f9fa; padding: 12px 20px; border-bottom: 1px solid #ddd; font-weight: bold;">
            Profil Petugas
        </div>
        <div style="padding: 20px;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 8px 15; width: 150px; font-weight: bold;">Nama</td>
                    <td style="padding: 8px 15;">: {{ $user->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 15; font-weight: bold;">Email</td>
                    <td style="padding: 8px 15;">: {{ $user->email }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px 15; font-weight: bold;">Role</td>
                    <td style="padding: 8px 15;">: <span style="text-transform: uppercase;">{{ $user->role }}</span></td>
                </tr>
            </table>
        </div>
    </div>

    {{-- Kartu Ganti Password --}}
    <div style="background: #fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="background: #f8f9fa; padding: 12px 20px; border-bottom: 1px solid #ddd; font-weight: bold;">
            Ganti Password
        </div>
        <div style="padding: 20px;">
            <form action="{{ route('profil.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 15px;">
                    <label for="password_lama" style="display: block; margin-bottom: 5px; font-weight: 500;">Password Lama</label>
                    <input type="password" id="password_lama" name="password_lama" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    @error('password_lama')
                        <div style="color: red; font-size: 12px; margin-top: 3px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 15px;">
                    <label for="password_baru" style="display: block; margin-bottom: 5px; font-weight: 500;">Password Baru</label>
                    <input type="password" id="password_baru" name="password_baru" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                    @error('password_baru')
                        <div style="color: red; font-size: 12px; margin-top: 3px;">{{ $message }}</div>
                    @enderror
                </div>

                <div style="margin-bottom: 20px;">
                    <label for="password_baru_confirmation" style="display: block; margin-bottom: 5px; font-weight: 500;">Konfirmasi Password Baru</label>
                    <input type="password" id="password_baru_confirmation" name="password_baru_confirmation" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                </div>

                <button type="submit" style="background: #0d6efd; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; font-weight: bold;">Perbarui Password</button>
            </form>
        </div>
    </div>

</div>
@endsection