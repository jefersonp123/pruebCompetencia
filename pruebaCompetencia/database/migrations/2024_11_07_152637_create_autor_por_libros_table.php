<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutorPorLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autor_por_libros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_autor')->nullable();
            $table->foreign('id_autor')->references('id')->on('autors');
            $table->unsignedBigInteger('id_libro')->nullable();
            $table->foreign('id_libro')->references('id')->on('libros');
            $table->string('type_interaction');
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
        Schema::dropIfExists('autor_por_libros');
    }
}
