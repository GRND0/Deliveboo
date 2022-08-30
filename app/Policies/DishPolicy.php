<?php

namespace App\Policies;

use App\User;
use App\Dish;
use Illuminate\Auth\Access\HandlesAuthorization;

class DishPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function update(User $user, Dish $dish)
    {
        return $user->id === $dish->user_id;
    }
    public function show(User $user, Dish $dish)
    {
        return $user->id === $dish->user_id;
    }
    public function edit(User $user, Dish $dish)
    {
        return $user->id === $dish->user_id;
    }
    public function destroy(User $user, Dish $dish)
    {
        return $user->id === $dish->user_id;
    }

    
}
