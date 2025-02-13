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
        Schema::create('contact_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investor_id'); // Foreign key from investors table
            $table->string('concerned_person_name');
            $table->string('concerned_person_designation');
            $table->string('concerned_person_phone', 10);
            $table->string('email');
            $table->timestamps();
        
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_details');
    }
};
