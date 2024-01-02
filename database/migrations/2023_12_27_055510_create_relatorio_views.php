<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRelatorioViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("DROP VIEW IF EXISTS relatorioview");
        DB::statement("CREATE VIEW relatorioview AS
                        SELECT
                            A.Nome AS Autor,
                            L.Titulo AS Livro,
                            GROUP_CONCAT(DISTINCT S.Descricao ORDER BY S.Descricao ASC) AS Assuntos
                        FROM
                            Autor A
                            JOIN Livro_Autor LA ON A.CodAu = LA.Autor_Codau
                            JOIN Livro L ON LA.Livro_Codl = L.Codl
                            JOIN Livro_Assunto LS ON L.Codl = LS.Livro_Codl
                            JOIN Assunto S ON LS.Assunto_CodAs = S.CodAs
                        GROUP BY
                            A.CodAu, L.Titulo");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS relatorioview");
    }
}
