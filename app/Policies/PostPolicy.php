<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *this class will take care of authorizing actions against the post Model 
     * @return void
     */
    public function __construct()
    {
        //
    }
}
