@extends('adminlte::page')


@section('title')

@section('content_header')
    @include('componentes.mensagem')
@stop

@section('content')
    @include('componentes.loading')

    <div class="row">
        <div class="container-fluid">
            <div class="row">
                <!-- BEM VINDO -->
                <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-3">
                    <div class="card box-shadow">
                        <div class="card-body bemvindo-card">
                            <div class="row d-flex justify-content-center">
                                <div class="form-group">
                                    <h1 class="bemvindo-dashboard">Bem-vindo</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
