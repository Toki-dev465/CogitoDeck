<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Deck extends Model
{


    protected $fillable = [
        'title',
        'description',
        ];

// Deck has user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

// Deck has cards
    public function cards(): HasMany
    {
        return $this->hasMany(Flashcard::class);
    }

}
