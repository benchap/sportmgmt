<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('membership_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('membership_id');
            $table->unsignedInteger('team_id');
            $table->enum('status', ['pending','progress','processed','cancelled','expired','closed'])->default('pending');
            $table->enum('pay_status',['pending','paid','declined','unknown'])->default('pending');
            $table->dateTime('start_date')->nullable();
            $table->dateTime('expiry_date')->nullable();
            $table->string('email');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('postcode');
            $table->string('city');
            $table->date('DOB');
            $table->string('gender');
            $table->string('phone');
            $table->string('work_phone')->nullable();
            $table->string('emergency_name');
            $table->string('emergency_phone');
            $table->string('previous_injury')->nullable();
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
        Schema::dropIfExists('membership_orders');
    }
}
