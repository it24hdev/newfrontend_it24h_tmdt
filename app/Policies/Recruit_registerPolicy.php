<?php

namespace App\Policies;

use App\Models\Recruit_register;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Recruit_registerPolicy
{
    use HandlesAuthorization;

        public function view(User $user)
        {
            if ($user->is_admin == 1) {
                return \true;
            } else {
                return  $user->checkPermissionAccess('view_recruit_register');
            }
        }

        public function update(User $user)
        {
            if ($user->is_admin == 1) {
                return \true;
            } else {
                return  $user->checkPermissionAccess('update_recruit_register');
            }
        }
    
}
