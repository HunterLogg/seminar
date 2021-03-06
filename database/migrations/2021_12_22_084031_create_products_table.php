<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->string('name', 255);
            $table->longText('description');
            // $table->text('cpu');
            // $table->text('ram');
            // $table->text('disk');
            // $table->text('card');
            // $table->text('monitor');
            // $table->text('webcam');
            // $table->text('operating');
            // $table->text('pin');
            // $table->text('weith');
            $table->string('image');
            $table->string('price');
            $table->string('quantity');
            $table->integer('active');
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
        Schema::dropIfExists('products');
    }
}
