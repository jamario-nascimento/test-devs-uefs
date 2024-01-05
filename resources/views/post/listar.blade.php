@extends('adminlte::page')

@section('title')

@section('content_header')
    @include('componentes.mensagem')

    <div class="row">
        <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <h3 class="m-0" style="float:left"><i class="fa fa-fw fa-book"></i> Lista de Posts</h3>

            <a title="Adicionar" href="{{ route('cadastrarPost') }}"  class="btn btn-primary float-right">
                <i class="fa fa-plus"></i>
                Adicionar
            </a>
        </div>
    </div>

    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @endpush

    @push('js')
        <script src="{{ asset('js/listarPost.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @endpush
@stop

@section('content')

    @include('componentes.loading')

    @if (!empty($post) && count($post) > 0)
        <div class="card">
            <div class="card-body">
                <table id="table" class="table table-striped">
                    <thead class="thead-light">
                        <tr class="text-secondary">
                            <th class="text-center" scope="col">ID</th>
                            <th scope="col">Título</th>
                            <th scope="col">Autor</th>
                            <th scope="col">Resumo</th>
                            <th class="text-center" scope="col">Opções</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (!empty($post))
                            @foreach ($post as $p)
                                <tr>
                                    <td class="text-center">{{ $p->id }}</td>
                                    <td>{{ $p->titulo }}</td>
                                    <td>{{ $p->usuario }}</td>
                                    <td>{{ $p->resumo }}</td>

                                    <td class="text-center">
                                        <a title="Editar" href="{{ route('editarPost', $p->id) }}" class="mr-3">
                                            <i class="fa fa-pen"></i>
                                        </a>

                                        <a id="excluir" class="excluir" title="Excluir" href="javascript:void(0)" cod="{{ $p->id }}">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
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
