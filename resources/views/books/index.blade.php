
@extends('layouts.books')

@section('title', 'Data Buku')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title mb-1">Data Buku</h2>
        <p class="text-muted mb-0">Daftar koleksi buku dalam aplikasi.</p>
    </div>

    @can('books.create')
        <a href="{{ route('books.create') }}" class="btn btn-primary">
            + Tambah Buku
        </a>
    @endcan
</div>

<div class="content-card">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="60">No.</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td>{{ $loop->iteration + ($books->currentPage() - 1) * $books->perPage() }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publisher ?? '-' }}</td>
                        <td>{{ $book->published_year ?? '-' }}</td>
                        <td>
                            <div class="d-flex gap-2">

                                @can('books.edit')
                                    <a href="{{ route('books.edit', $book->id) }}"
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>
                                @endcan

                                @can('books.delete')
                                    <form action="{{ route('books.destroy', $book->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                @endcan

                                @cannot('books.edit')
                                    @cannot('books.delete')
                                        <span class="text-muted">Tidak ada aksi</span>
                                    @endcannot
                                @endcannot

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Belum ada data buku.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection
