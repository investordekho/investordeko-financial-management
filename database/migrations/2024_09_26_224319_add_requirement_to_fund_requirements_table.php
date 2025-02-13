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
        Schema::table('fund_requirements', function (Blueprint $table) {
            $table->decimal('requirement', 15, 2); // Add the new column
        });
    }
    
    public function down()
    {
        Schema::table('fund_requirements', function (Blueprint $table) {
            $table->dropColumn('requirement');
        });
    }
};
