<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;

class BookPolicy
{
    public function viewAny(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function update(User $user)
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    public function delete(User $user)
    {
        return $user->role === 'admin';
    } // ← Tambahkan penutup } di sini

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Book $book): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Book $book): bool
    {
        return false;
    }
}