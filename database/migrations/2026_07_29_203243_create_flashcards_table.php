<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flashcards', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('deck_id')->constrained()->onDelete('cascade'); // Links to the deck
            $table->text('front_text')->nullable();
            $table->string('front_image_path')->nullable(); // photos
            $table->text('back_text')->nullable();

            // spaced repetition data

        
        
        
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flashcards');
    }
};
