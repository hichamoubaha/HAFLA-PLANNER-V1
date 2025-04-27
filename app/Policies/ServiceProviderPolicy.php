<?php

namespace App\Policies;

use App\Models\ServiceProvider;
use App\Models\User;

class ServiceProviderPolicy
{
    public function update(User $user, ServiceProvider $provider)
    {
        return $user->id === $provider->user_id;
    }

    public function delete(User $user, ServiceProvider $provider)
    {
        return $user->id === $provider->user_id;
    }
} 