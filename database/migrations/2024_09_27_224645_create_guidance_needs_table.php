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
        Schema::create('guidance_needs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investor_id'); // Foreign key from investors table
            $table->json('guidance_needed'); // Store selected guidance as JSON
            $table->string('other_guidance')->nullable(); // If "Others" is selected
            $table->timestamps();
        
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guidance_needs');
    }
};
