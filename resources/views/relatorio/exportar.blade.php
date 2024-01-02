<html lang="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Autores</title>
</head>
<style>
    .page-break {
        page-break-after: always;
    }
</style>

<body>

<center>
    <h1>Relatório de Autores</h1>
</center>

<table border="1" padding-left="0" margin-left="0" style="width: 100%;">
    <thead>
        <tr>
            <th style="text-align: left;">Autor</th>
            <th style="text-align: left;">Livro</th>
            <th style="text-align: left;">Assuntos</th>
        </tr>
    </thead>

    <tbody>
    @foreach ($relatorios as $rel)
        <tr>
            <td>{{ $rel->Autor }}</td>
            <td>{{ $rel->Livro }}</td>
            <td>{{ $rel->Assuntos }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>

</html>
