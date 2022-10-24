<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('category_providers')->cascadeOnDelete();
            $table->json('parents')->nullable();
            $table->text('description')->nullable();
            $table->enum('stauts',['0','1'])->default('1');
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('category_provider_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_provider_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_providers');
    }
}
