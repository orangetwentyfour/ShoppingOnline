<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('quantity')->unsigned();
            $table->text('description');
            $table->string('summary')->default('');
            $table->integer('views')->default(0);
            $table->double('standard_price')->default(0);
            $table->double('price'); // price for sale after discount
            $table->integer('display_order')->default(0);
            $table->double('star')->default(1);
            $table->boolean('is_approved')->default(false);
            $table->integer('created_user')->unsigned();
            $table->softDeletes();

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
