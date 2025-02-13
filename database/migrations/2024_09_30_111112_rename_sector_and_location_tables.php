<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameSectorAndLocationTables extends Migration
{
    /**
     * Run the migrations to rename tables.
     *
     * @return void
     */
    public function up()
    {
        // Rename sector table to sector_details
        Schema::rename('sectors', 'sector_details');

        // Rename location table to location_details
        Schema::rename('locations', 'location_details');
    }

    /**
     * Reverse the migrations (rename back).
     *
     * @return void
     */
    public function down()
    {
        // Rename sector_details back to sector
        Schema::rename('sector_details', 'sectors');

        // Rename location_details back to location
        Schema::rename('location_details', 'locations');
    }
}
