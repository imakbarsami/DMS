<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocumentsToDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
{
    Schema::table('drivers', function (Blueprint $table) {
        $table->string('driving_license_img')->nullable()->after('license_number');
        $table->string('nid_img')->nullable()->after('nid_number');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::table('drivers', function (Blueprint $table) {
        $table->dropColumn(['driving_license_img', 'nid_img']);
        });
    }
}
