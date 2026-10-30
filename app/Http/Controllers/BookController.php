<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private function checkPermission(Request $request, string $permission): void
    {
        abort_unless(
            $request->user()->can($permission),
            403
        );
    }

    // Menampilkan daftar buku
    public function index(Request $request)
    {
        $this->checkPermission($request, 'books.view');

        $books = Book::latest()->paginate(10);

        return view('books.index', compact('books'));
    }

    // Menampilkan form tambah buku
    public function create(Request $request)
    {
        $this->checkPermission($request, 'books.create');

        return view('books.create');
    }

    // Menyimpan buku baru
    public function store(Request $request)
    {
        $this->checkPermission($request, 'books.create');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'published_year' => 'nullable|integer|min:1000|max:2100',
        ]);

        Book::create($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan form edit buku
    public function edit(Request $request, Book $book)
    {
        $this->checkPermission($request, 'books.edit');

        return view('books.edit', compact('book'));
    }

    // Memperbarui data buku
    public function update(Request $request, Book $book)
    {
        $this->checkPermission($request, 'books.edit');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'published_year' => 'nullable|integer|min:1000|max:2100',
        ]);

        $book->update($validated);

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy(Request $request, Book $book)
    {
        $this->checkPermission($request, 'books.delete');

        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
