@extends('adminlte::page')

@section('title')

@section('content_header')
    @include('componentes.mensagem')

    <div class="row">
        <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h3 class="m-0" style="float:left"><i class="fa fa-fw fa-star"></i> Relatório de Autores</h3>

            <a title="Exportar" href="{{ route('exportarRelatorio') }}"  class="btn btn-primary float-right">
                <i class="fa fa-fw fa-star"></i>
                Exportar
            </a>
        </div>
    </div>

    @push('css')
    @endpush

    @push('js')
    @endpush
@stop

@section('content')

    @include('componentes.loading')

    @if (!empty($relatorios) && count($relatorios) > 0)
        <div class="card">
            <div class="card-body">
                <table id="table" class="table table-striped">
                    <thead class="thead-light">
                        <tr class="text-secondary">
                            <th scope="col">Autor</th>
                            <th scope="col">Livro</th>
                            <th scope="col">Assuntos</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (!empty($relatorios))
                            @foreach ($relatorios as $p)
                                <tr>
                                    <td>{{ $p->Autor }}</td>
                                    <td>{{ $p->Livro }}</td>
                                    <td>{{ $p->Assuntos }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="alert alert-warning mt-3 mb-3" role="alert">
            A consulta não retornou resultado.
        </div>
    @endif
@stop
