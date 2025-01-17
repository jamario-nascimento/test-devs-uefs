@extends('adminlte::page')

@section('title')

@section('content_header')
    <h3 class="m-0"><i class="fa fa-fw fa-comment" aria-hidden="true"></i> {{ $title_page ?? 'Cadastrar Usuário' }} </h3>

    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @endpush

    @push('js')
        <script src="{{ asset('js/manterUsuario.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @endpush
@stop

@section('content')
    @include('componentes.mensagem')

    <label class="text-danger">
        <small> Campos marcados com (*) são obrigatórios.</small>
    </label>

    <form action="#" method="post" class="needs-validation" novalidate>
        <div class="row">
            <!-- usuario -->
            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card box-shadow">
                    <div class="card-header border-0 no-bg-color">
                        <h5 class="card-subtitle mt-1">Dados do Usuário</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $usuario->id ?? null }}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="manter" id="manter" value="{{ $MANTER ?? 'Salvar' }}" />

                            <!-- nome -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="text-input">Nome *</label>
                                <input id="nome" name="nome" type="text" class="form-control validarErro" value="{{ old('nome', $usuario->nome ?? null) }}" maxlength="100" autocomplete="off" required>

                                <div class="invalid-feedback"></div>

                                <label id="nome-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                             <!-- data de nascimento -->
                             <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="text-input">Data de Nascimento *</label>
                                <input id="data_nascimento" name="data_nascimento" type="date" class="form-control validarErro" value="{{ old('data_nascimento', $usuario->data_nascimento ?? null) }}" autocomplete="off" required>

                                <div class="invalid-feedback"></div>

                                <label id="data_nascimento-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                            <!-- email -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="text-input">E-mail *</label>
                                <input id="email" name="email" type="email" class="form-control validarErro" value="{{ old('email', $usuario->email ?? null) }}" maxlength="100" autocomplete="off" required>

                                <div class="invalid-feedback"></div>

                                <label id="email-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>
                        </div>
                    </div>
                </div>

                @include('componentes.loading')

                <div class="row">
                    <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <button id="{{ $MANTER ?? 'Cadastrar' }}" class="btn btn-primary float-right">
                            <i class="fa fa-floppy-o" aria-hidden="true"></i>
                            {{ $MANTER ?? 'Cadastrar' }}
                        </button>

                        <button type="button" onclick=location.href="{{ route('indexUsuario') }}" class="btn btn-secondary mr-3 mb-5 float-left">
                            <i class="fa fa-step-backward" aria-hidden="true"></i> Voltar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@stop
