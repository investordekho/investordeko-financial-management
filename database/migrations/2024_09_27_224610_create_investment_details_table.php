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
        Schema::create('investment_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investor_id'); // Foreign key from investors table
            $table->enum('invest_in', ['listed shares', 'unlisted shares', 'both']);
            $table->string('investor_type');
            $table->string('investment_size');
            $table->string('investment_tenure');
            $table->timestamps();
        
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_details');
    }
};
