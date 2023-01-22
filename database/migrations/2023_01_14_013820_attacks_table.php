<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('creature_id')->unsigned();
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('special')->nullable();
            $table->string('bonus')->nullable();
            $table->string('damage')->nullable();
            $table->string('recharge')->nullable();
            $table->string('rr')->nullable();
            $table->string('tip')->nullable();
            $table->string('actions')->nullable();
            $table->integer('uses')->nullable();
            
            $table->foreign('creature_id')->references('id')->on('creatures')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
