<?php

namespace App\Policies;

use App\Models\Flashcard;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FlashcardPolicy
{
   
    public function view(User $user, Flashcard $flashcard): bool
    {
        return $user->id === $flashcard->deck->user_id;
    }



    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Flashcard $flashcard): bool
    {
        return $user->id === $flashcard->deck->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Flashcard $flashcard): bool
    {
        return $user->id === $flashcard->deck->user_id;
    }

 
}
