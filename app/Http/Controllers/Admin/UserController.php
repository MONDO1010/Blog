<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(User $user)
    {
        $user->update([
            'is_admin' => !$user->is_admin
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Statut administrateur mis à jour avec succès!');
    }
}
