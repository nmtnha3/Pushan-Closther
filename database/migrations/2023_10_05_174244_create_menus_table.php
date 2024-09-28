<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('menus');
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
