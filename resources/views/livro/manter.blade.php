@extends('adminlte::page')

@section('title')

@section('content_header')
    <h3 class="m-0"><i class="fa fa-fw fa-book" aria-hidden="true"></i> {{ $title_page ?? 'Cadastrar Livro' }} </h3>

    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @endpush

    @push('js')
        <script src="{{ asset('js/manterLivro.js') }}"></script>
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
            <!-- Livro -->
            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card box-shadow">
                    <div class="card-header border-0 no-bg-color">
                        <h5 class="card-subtitle mt-1">Dados do Livro</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" name="Codl" value="{{ $livro->Codl ?? null }}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="manter" id="manter" value="{{ $MANTER ?? 'Salvar' }}" />

                            <!-- Titulo -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="text-input">Titulo *</label>
                                <input id="Titulo" name="Titulo" type="text" class="form-control validarErro" value="{{ old('Titulo', $livro->Titulo ?? null) }}" maxlength="40" autocomplete="off" required>

                                <div class="invalid-feedback"></div>

                                <label id="Titulo-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                            <!-- Editora -->
                            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="text-input">Editora *</label>
                                <input id="Editora" name="Editora" type="text" class="form-control validarErro" value="{{ old('Editora', $livro->Editora ?? null) }}" maxlength="40" autocomplete="off" required>

                                <div class="invalid-feedback"></div>

                                <label id="Editora-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                            <!-- Edicao -->
                            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="text-input">Edicao *</label>
                                <input id="Edicao" name="Edicao" type="text" class="form-control validarErro" value="{{ old('Edicao', $livro->Edicao ?? null) }}" maxlength="10" autocomplete="off" required>

                                <div class="invalid-feedback"></div>

                                <label id="Edicao-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                            <!-- AnoPublicacao -->
                            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="text-input">AnoPublicacao *</label>
                                <input id="AnoPublicacao" name="AnoPublicacao" type="text" class="form-control validarErro" value="{{ old('AnoPublicacao', $livro->AnoPublicacao ?? null) }}" maxlength="4" autocomplete="off" required>

                                <div class="invalid-feedback"></div>

                                <label id="AnoPublicacao-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                            <!-- Valor -->
                            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="text-input">Valor *</label>
                                <input id="Valor" name="Valor" type="text" class="form-control validarErro" value="{{ old('Valor', isset($livro->Valor) ? number_format($livro->Valor, 2, ',', '.') : null) }}" maxlength="8" autocomplete="off" required>

                                <div class="invalid-feedback"></div>

                                <label id="Valor-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                            <!-- Autores -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <hr>
                                <label class="text-input">Autor *</label>
                            </div>
                            <div class="form-group row col-sm-12 col-md-12 col-lg-12 col-xl-12 ml-1">
                                @if (!empty($autores))
                                    @foreach ($autores as $autor)
                                    <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 form-check">
                                        <input type="checkbox" class="form-check-input" name="Autores[]" id="autor{{ $autor->CodAu }}" value="{{ $autor->CodAu }}" {{ in_array($autor->CodAu,$listAutores)  ? ' checked ' : '' }}>
                                        <label class="form-check-label" for="autor{{ $autor->CodAu }}">{{ $autor->Nome }}</label>
                                    </div>
                                    @endforeach
                                @else
                                    <option value="">Autor não encontrado</option>
                                @endif

                                <div class="invalid-feedback"></div>
                            </div>

                            <!-- Assunto -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <hr>
                                <label class="text-input">Assunto *</label>
                            </div>
                            <div class="form-group row col-sm-12 col-md-12 col-lg-12 col-xl-12 ml-1">
                                @if (!empty($assuntos))
                                    @foreach ($assuntos as $assunto)
                                    <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 form-check">
                                        <input type="checkbox" class="form-check-input" name="Assuntos[]" id="assunto{{ $assunto->CodAs }}" value="{{ $assunto->CodAs }}" {{ in_array($assunto->CodAs,$listAssuntos)  ? ' checked ' : '' }}>
                                        <label class="form-check-label" for="assunto{{ $assunto->CodAs }}">{{ $assunto->Descricao }}</label>
                                    </div>
                                    @endforeach
                                @else
                                    <option value="">Assunto não encontrado</option>
                                @endif

                                <div class="invalid-feedback"></div>
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

                        <button type="button" onclick=location.href="{{ route('indexLivro') }}" class="btn btn-secondary mr-3 mb-5 float-left">
                            <i class="fa fa-step-backward" aria-hidden="true"></i> Voltar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@stop
