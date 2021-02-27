<?php

use App\Entity\Characteristic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedInteger('price');
            $table->timestamps();
        });

        Schema::create('product_characteristics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('type')->default(Characteristic::TYPE_STRING);
            $table->json('options')->nullable();
            $table->timestamps();
        });

        Schema::create('product_characteristic_values', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('characteristic_id');

            $table->text('value');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('characteristic_id')->references('id')->on('product_characteristics');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_characteristic_values');
        Schema::dropIfExists('product_characteristics');
        Schema::dropIfExists('products');
    }
}
