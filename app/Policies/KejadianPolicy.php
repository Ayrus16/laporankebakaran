<?php

namespace App\Policies;

use App\Models\Kejadian;
use App\Models\User;

class KejadianPolicy
{
    public function before(User $user, string $ability): ?bool
    {
        return $user->hasRole('admin') ? true : null; 
    }

    public function viewAny(User $user): bool
    {
        return $user->can('kejadian.viewAny');
    }

    public function view(User $user, Kejadian $kejadian): bool
    {
        return $user->can('kejadian.view')
            && (int) $user->idKantor === (int) $kejadian->kantor_id;
    }

    public function create(User $user): bool
    {
        return $user->can('kejadian.create');
    }

    public function update(User $user, Kejadian $kejadian): bool
    {
        return $user->can('kejadian.update')
            && (int) $user->idKantor === (int) $kejadian->kantor_id;
    }

    public function delete(User $user, Kejadian $kejadian): bool
    {
        return $user->can('kejadian.delete')
            && (int) $user->idKantor === (int) $kejadian->kantor_id;
    }
}
