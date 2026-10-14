<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book; 
use App\Models\Member; 
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{
    public function index()
    {
        Loan::where('status', 'dipinjam')
        ->whereDate('tanggal_kembali', '<', now())
        ->update(['status' => 'terlambat']);    

        $loans = Loan::with(['member', 'user', 'loanItems.book'])
        ->orderBy('id', 'asc')
        ->paginate(10);

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $members = Member::all();
        $books = Book::where('stok', '>', 0)->get();

        return view('loans.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|integer|exists:members,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'book_ids' => 'required|array|min:1',
            'book_ids.*' => 'integer|exists:books,id',
        ]);

    DB::transaction(function () use ($validated) {
            $loan = Loan::create([
                'member_id' => $validated['member_id'],
                'user_id' => auth()->id(),
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_kembali' => $validated['tanggal_kembali'],
                'status' => 'dipinjam', 
            ]);

        foreach ($validated['book_ids'] as $bookId) {
                // Simpan loan item
                $loan->loanItems()->create(['book_id' => $bookId]);

                // Kurangi stok buku sebanyak 1
                $book = Book::findOrFail($bookId);
                $book->decrement('stok'); 
                // Atau bisa juga: 
                // $book->stok -= 1;
                // $book->save();
            }
        });

        return redirect()->route('loans.index')
            ->with('success', 'Transaksi peminjaman berhasil dibuat dan stok buku telah dikurangi.');
    }

    public function show(string $id)
    {
        $loan = Loan::with(['member', 'user', 'loanItems.book'])->findOrFail($id);

        return view('loans.show', compact('loan'));
    }

    public function edit(string $id)
    {
        $loan = Loan::with(['member', 'user', 'loanItems.book'])->findOrFail($id);

        return view('loans.edit', compact('loan'));
    }

    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail($id);

        $validated = $request->validate([
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:dipinjam,dikembalikan,terlambat',
        ], [
            'tanggal_kembali.required' => 'Tanggal kembali wajib diisi.',
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali tidak boleh sebelum tanggal pinjam.',
        ]);

        $loan->update($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Transaksi peminjaman berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        // Jika transaksi dihapus, idealnya stok dikembalikan jika statusnya masih dipinjam
        DB::transaction(function () use ($id) {
            $loan = Loan::with('loanItems')->findOrFail($id);

            // Jika dihapus saat status masih dipinjam, kembalikan stok bukunya
            if ($loan->status === 'dipinjam') {
                foreach ($loan->loanItems as $item) {
                    $book = Book::find($item->book_id);
                    if ($book) {
                        $book->increment('stok');
                    }
                }
            }

            $loan->loanItems()->delete();
            $loan->delete();
        });

        return redirect()->route('loans.index')
            ->with('success', 'Transaksi peminjaman berhasil dihapus.');
    }

    public function kembalikan(string $id)
    {
        DB::transaction(function () use ($id) {
            $loan = Loan::with('loanItems')->findOrFail($id);

            // Ubah status loan menjadi dikembalikan
            $loan->update([
                'status' => 'dikembalikan',
                'tanggal_dikembalikan' => now()->toDateString(),
            ]);

            // Kembalikan stok setiap buku yang dipinjam
            foreach ($loan->loanItems as $item) {
                $book = Book::find($item->book_id);
                if ($book) {
                    $book->increment('stok'); // Bertambah 1
                }
            }
        });

        return redirect('/loans')->with('success', 'Buku berhasil dikembalikan.');
    }
}