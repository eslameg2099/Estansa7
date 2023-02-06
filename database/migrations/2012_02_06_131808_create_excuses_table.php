<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id');
            $table->foreign('provider_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('reservation_id');
            $table->foreign('reservation_id')->references('id')->on('reservations')->cascadeOnDelete();
            $table->text('comment',500)->nullable();
            $table->text('reason',500)->nullable();
            $table->enum('type',['1','2'])->default('1');
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
        Schema::dropIfExists('excuses');
    }
}
