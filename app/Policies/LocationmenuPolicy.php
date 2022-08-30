<?php

namespace App\Policies;

use App\Models\Locationmenu;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationmenuPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        if ($user->is_admin == 1) {
            return \true;
        } else {
            return  $user->checkPermissionAccess('view_locationmenu');
        }
    }

 
    public function update(User $user)
    {
        if ($user->is_admin == 1) {
            return \true;
        } else {
            return  $user->checkPermissionAccess('update_locationmenu');
        }
    }
}
