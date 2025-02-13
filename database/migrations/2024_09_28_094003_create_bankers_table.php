<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('bankers', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->string('company_name');
        $table->year('incorporated_in');
        $table->string('ib_team_size');
        $table->string('company_profile')->nullable();
        $table->string('address');
        $table->string('location');
        $table->string('state');
        $table->string('country');
        $table->string('min_fund_raise_size');
        $table->string('max_fund_raise_size');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bankers');
    }
};
