<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->nullable();
            $table->string('firstname');
            $table->string('surname');
            $table->string('middlename')->nullable();
            $table->string('email_a')->nullable();
            $table->string('email_b')->nullable();
            $table->TEXT('address');
            $table->string('phone_number_a')->nullable();
            $table->string('phone_number_b')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('date_married')->nullable();
            $table->string('spouse_qualification')->nullable();
            $table->string('all_education')->nullable();
            $table->string('all_parish')->nullable();
            $table->string('all_perferment')->nullable();
            $table->string('current_province')->nullable();
            $table->string('current_diocese')->nullable();
            $table->string('current_archdeaconary')->nullable();
            $table->string('current_parish')->nullable();
            $table->string('inserted_by')->nullable();
            $table->string('date_created');
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
        Schema::dropIfExists('profiles');
    }
}
