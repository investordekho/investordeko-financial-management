<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('investor_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('investor_id'); // Foreign key to investors table
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('zip_code');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('investor_id')->references('id')->on('investors')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('investor_addresses');
    }
};
