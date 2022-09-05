<?php

namespace App\Policies;

use App\Models\Recruit;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecruitPolicy
{
    use HandlesAuthorization;


        public function view(User $user)
        {
            if ($user->is_admin == 1) {
                return \true;
            } else {
                return  $user->checkPermissionAccess('view_recruit');
            }
        }

        public function create(User $user)
        {
            if ($user->is_admin == 1) {
                return \true;
            } else {
                return  $user->checkPermissionAccess('create_recruit');
            }
        }

        public function update(User $user)
        {
            if ($user->is_admin == 1) {
                return \true;
            } else {
                return  $user->checkPermissionAccess('update_recruit');
            }
        }
        public function delete(User $user)
        {
            if ($user->is_admin == 1) {
                return \true;
            } else {
                return  $user->checkPermissionAccess('delete_recruit');
            }
        }
}
