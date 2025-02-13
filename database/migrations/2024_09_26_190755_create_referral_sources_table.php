<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralSourcesTable extends Migration
{
    public function up()
    {
        Schema::create('referral_sources', function (Blueprint $table) {
            $table->id();
            $table->string('source_name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('referral_sources');
    }
}

