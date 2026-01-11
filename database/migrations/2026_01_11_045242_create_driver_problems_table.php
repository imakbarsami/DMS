<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_problems', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('driver_id');
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->string('vehicle_number'); 
            $table->string('type'); 
            $table->string('severity')->default('Low'); 
            $table->text('description')->nullable(); 
            $table->string('place')->nullable();
            $table->dateTime('occurrence_date'); 
            $table->decimal('cost', 10, 2)->nullable(); 
            $table->string('status')->default('Pending'); 
            $table->text('admin_note')->nullable(); 
            $table->string('proof_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('driver_problems');
    }
}
