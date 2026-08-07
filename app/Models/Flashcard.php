<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    

    protected $fillable = [
        'front_text',
        'front_image_path',
        'back_text',
        'back_image_path',
    ];


// flashcard belongs to a deck

    public function deck(): BelongsTo
    {
        return $this->belongsTo(Deck::class);
    }


}
