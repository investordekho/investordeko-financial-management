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
        Schema::create('public_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investor_id'); // Foreign key from investors table
            $table->string('url');
            $table->string('link_description'); // Facebook, Twitter, etc.
            $table->timestamps();
        
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_links');
    }
};
