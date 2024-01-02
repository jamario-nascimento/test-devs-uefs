<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivroAutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Livro_Autor', function (Blueprint $table) {
            $table->unsignedBigInteger('Livro_Codl');
            $table->unsignedBigInteger('Autor_Codau');

            $table->foreign('Livro_Codl','Livro_Autor_FKIndex1')->references('Codl')->on('Livro');
            $table->foreign('Autor_CodAu','Livro_Autor_FKIndex2')->references('CodAu')->on('Autor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Livro_Autor');
    }
}
