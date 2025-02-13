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
        Schema::create('banker_referrals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('banker_id');
            $table->string('referral_source');
            $table->timestamps();
    
            $table->foreign('banker_id')->references('id')->on('bankers')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banker_referrals');
    }
};
