<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    private array $members = [
        ['id' => 1, 'nama' => 'John Doe', 'nim' => '1234567890', 'email' => 'john.doe@example.com', 'nomor_telepon' => '1234567890', 'alamat' => 'Jl. Merdeka No. 1', 'status' => 'Mahasiswa'],
        ['id' => 2, 'nama' => 'Jane Smith', 'nim' => '0987654321', 'email' => 'jane.smith@example.com', 'nomor_telepon' => '0987654321', 'alamat' => 'Jl. Sudirman No. 2', 'status' => 'Mahasiswa'],
        ['id' => 3, 'nama' => 'Bob Johnson', 'nim' => '1122334455', 'email' => 'bob.johnson@example.com', 'nomor_telepon' => '1122334455', 'alamat' => 'Jl. Diponegoro No. 3', 'status' => 'Mahasiswa'],
    ];


    public function index()
    {
        $members = $this->members;

        return view('members.index', compact('members'));
    }

    public function create()
    {
      return view('members.create');
    }

    public function store(StoreMemberRequest $request)
    {
         $validated = $request->validated();

        return redirect()->route('members.index')
            ->with('success', "Member \"{$validated['nama']}\" berhasil ditambahkan (data dummy, belum tersimpan ke database).");
    }

    public function show(string $id)
    {
        $member = collect($this->members)->firstWhere('id', (int) $id);

        abort_if(! $member, 404);

        return view('members.show', compact('member'));
    }

    public function edit(string $id)
    {
        $member = collect($this->members)->firstWhere('id', (int) $id);

        abort_if(! $member, 404);

        $members = $this->members;

        return view('members.edit', compact('member'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:200',
            'nim' => 'required|string|max:20',
            'email' => 'required|email|max:100',
            'nomor_telepon' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'status' => 'required|string|max:100',
        ]);

        return redirect()->route('members.index')
            ->with('success', "Member \"{$validated['nama']}\" berhasil diperbarui (data dummy, belum tersimpan ke database).");
    }

    public function destroy(string $id)
    {
        return redirect()->route('members.index')
            ->with('success', "Member dengan id {$id} berhasil dihapus (data dummy, belum tersimpan ke database).");
    }
}