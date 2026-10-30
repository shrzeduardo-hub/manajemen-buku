
@extends('layouts.books')

@section('title', 'Kelola Pengguna')

@section('content')

<div class="mb-4">
    <h2 class="page-title">Kelola Role Pengguna</h2>
    <p class="text-muted">Admin dapat mengatur hak akses setiap pengguna.</p>
</div>

<div class="content-card">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Nama Pengguna</th>
                    <th>Email</th>
                    <th>Role Saat Ini</th>
                    <th width="250">Atur Role</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>
                            {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                        </td>

                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <td>
                            @forelse ($user->roles as $role)
                                <span class="badge bg-primary">
                                    {{ $role->name }}
                                </span>
                            @empty
                                <span class="text-muted">Belum memiliki role</span>
                            @endforelse
                        </td>

                        <td>
                            @if (auth()->id() === $user->id)
                                <span class="text-muted">
                                    Akun yang sedang digunakan
                                </span>
                            @else
                                <form action="{{ route('users.update-role', $user->id) }}"
                                      method="POST"
                                      class="d-flex gap-2">

                                    @csrf
                                    @method('PUT')

                                    <select name="role" class="form-select" required>
                                        <option value="">Pilih Role</option>

                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                @selected($user->hasRole($role->name))>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn btn-primary btn-sm">
                                        Simpan
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            Belum ada pengguna.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links('pagination::bootstrap-5') }}

</div>

@endsection
