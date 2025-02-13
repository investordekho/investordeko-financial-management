<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToReferralSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('referral_sources', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->after('id');

            // If there is a relationship with the companies table, you can add the foreign key constraint
            // $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('referral_sources', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
    }
}
