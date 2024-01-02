<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivroAssuntoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Livro_Assunto', function (Blueprint $table) {
            $table->unsignedBigInteger('Livro_Codl');
            $table->unsignedBigInteger('Assunto_CodAs');

            $table->foreign('Livro_Codl','Livro_Assunto_FKIndex1')->references('Codl')->on('Livro');
            $table->foreign('Assunto_CodAs','Livro_Assunto_FKIndex2')->references('CodAs')->on('Assunto');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Livro_Assunto');
    }
}
