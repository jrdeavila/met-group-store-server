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
    Schema::create('items', function (Blueprint $table) {
      $table->id();
      $table->string('name')->unique();
      $table->float('price');
      $table->foreignId('store_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete()
        ->cascadeOnUpdate();
      $table->timestamps();
      $table->softDeletes();
    });
  }
  public function down()
  {
    Schema::dropIfExists('items');
  }
};
