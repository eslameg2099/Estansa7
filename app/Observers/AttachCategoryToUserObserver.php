<?php

namespace App\Observers;

use App\Models\User;

class AttachCategoryToUserObserver
{
    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function saved(User $user)
    {
        if ($user->category) {
            $user->categories()->sync($user->category->getModelWithParents());
        }
    }
}
