<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreignId('provider_id');
            $table->foreign('provider_id')->references('id')->on('users')->cascadeOnDelete();
            $table->enum('stauts',['0','1','2'])->default('0');
            $table->decimal('cost')->default(0);
            $table->time('from');
            $table->time('to');
            $table->integer('category_id')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->text('comment')->nullable();
            $table->date('day_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
