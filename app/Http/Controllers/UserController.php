<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private function checkPermission(Request $request): void
    {
        abort_unless(
            $request->user()->can('users.manage-roles'),
            403
        );
    }

    // Menampilkan daftar pengguna
    public function index(Request $request)
    {
        $this->checkPermission($request);

        $users = User::with('roles')
            ->orderBy('name')
            ->paginate(10);

        $roles = Role::where('guard_name', 'web')
            ->orderBy('name')
            ->get();

        return view('users.index', compact('users', 'roles'));
    }

    // Memperbarui role pengguna
    public function update(Request $request, User $user)
    {
        $this->checkPermission($request);

        // Admin tidak boleh mengubah role akunnya sendiri
        if ($request->user()->is($user)) {
            return back()->with(
                'error',
                'Anda tidak dapat mengubah role akun sendiri.'
            );
        }

        $validated = $request->validate([
            'role' => [
                'required',
                'string',
                Rule::exists('roles', 'name')
                    ->where('guard_name', 'web'),
            ],
        ]);

        $user->syncRoles([$validated['role']]);

        return redirect()
            ->route('users.index')
            ->with('success', 'Role pengguna berhasil diperbarui.');
    }
}
