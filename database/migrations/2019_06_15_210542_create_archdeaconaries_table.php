<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchdeaconariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archdeaconaries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('archdeaconary_name');
            $table->string('date_created');
            $table->string('diocese_id');
            $table->string('province_id');
            $table->string('inserted_by');
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
        Schema::dropIfExists('archdeaconaries');
    }
}
