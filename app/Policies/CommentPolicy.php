<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //authorizing a user to edit a given post 
    public function update(User $user,Comment $comment)
    {
        //determine if the user is the owner of the comment 
        return $user->email === $comment->email ;
    }

    //authorizing a user to delete a given comment
    public function delete(User $user,Comment $comment)
    {
        //verify if the user email is the same as the email of the person that created the comment
        return $user->email === $comment->email ;
    }
}
