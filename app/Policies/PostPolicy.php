<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;
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
    //handles creating a post 
    public function update(User $user,Post $post)
    {
        return $user->id === $post->user_id ;
    }

    public function delete(User $user,Post $post)
    {
        return $user->id === $post->user_id ;
    }
    public function edit(User $user,Post $post)
    {
        return $user->id === $post->user_id ;
    }
}
