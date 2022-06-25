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
    //handles updating a post instance
    public function update(User $user,Post $post)
    {
        //verify if the user's id is the same as the user_id of the post 
        return $user->id === $post->user_id ;
    }

    //authorizes a user to delete a post 
    public function delete(User $user,Post $post)
    {
        return $user->id === $post->user_id ;
    }
    
}
