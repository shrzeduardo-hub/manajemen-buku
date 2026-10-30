
@extends('layouts.books')

@section('title', 'Tambah Buku')

@section('content')

<div class="mb-4">
    <h2 class="page-title">Tambah Buku</h2>
    <p class="text-muted">Masukkan informasi buku baru.</p>
</div>

<div class="content-card">

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul Buku</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="{{ old('title') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Penulis</label>
            <input type="text"
                   name="author"
                   class="form-control"
                   value="{{ old('author') }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Penerbit</label>
            <input type="text"
                   name="publisher"
                   class="form-control"
                   value="{{ old('publisher') }}">
        </div>

        <div class="mb-4">
            <label class="form-label">Tahun Terbit</label>
            <input type="number"
                   name="published_year"
                   class="form-control"
                   value="{{ old('published_year') }}"
                   min="1000"
                   max="2100">
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Buku
        </button>

        <a href="{{ route('books.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>

</div>

@endsection
