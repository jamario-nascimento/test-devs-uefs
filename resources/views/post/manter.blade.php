@extends('adminlte::page')

@section('title')

@section('content_header')
<h3 class="m-0"><i class="fa fa-fw fa-book" aria-hidden="true"></i> {{ $title_page ?? 'Cadastrar Post' }} </h3>

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@push('js')
<script src="{{ asset('js/manterPost.js') }}"></script>
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
        <!-- Post -->
        <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class="card box-shadow">
                <div class="card-header border-0 no-bg-color">
                    <h5 class="card-subtitle mt-1">Dados do Post</h5>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8">
                            <input type="hidden" name="id" value="{{ $post->id ?? null }}" />
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="manter" id="manter" value="{{ $MANTER ?? 'Salvar' }}" />

                            <!-- Titulo -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="text-input">Titulo *</label>
                                <input id="titulo" name="titulo" type="text" class="form-control validarErro" value="{{ old('titulo', $post->titulo ?? null) }}" maxlength="100" autocomplete="off" required>

                                <div class="invalid-feedback"></div>

                                <label id="titulo-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                            <!-- Resumo -->
                            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="text-input">Resumo *</label>
                                <input id="resumo" name="resumo" type="text" class="form-control validarErro" value="{{ old('resumo', $post->resumo ?? null) }}" maxlength="200" autocomplete="off" required>

                                <div class="invalid-feedback"></div>

                                <label id="resumo-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                            <!-- Usuário -->
                            <div class="form-group col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                <label class="text-input">Autor *</label>
                                <select class="form-control m-bot15" name="usuario" id="usuario" required>
                                    @if($usuarios->count() > 0)
                                    @foreach($usuarios as $usuario)
                                    <option value="{{$usuario->id}}">{{$usuario->nome}}</option>
                                    @endForeach
                                    @else
                                    No Record Found
                                    @endif
                                </select>
                                <!-- <input  name="usuario" type="text" class="form-control validarErro" value="{{ old('usuario', $post->usuario ?? null) }}" maxlength="8" autocomplete="off" > -->
                                <div class="invalid-feedback"></div>
                                <label id="usuario-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                            <!-- Conteúdo -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <label class="text-input">Conteudo *</label>
                                <textarea id="conteudo" name="conteudo" type="text" class="form-control validarErro" value="{{ old('conteudo', $post->conteudo ?? null) }}" autocomplete="off" required>
                                </textarea>
                                <div class="invalid-feedback"></div>

                                <label id="conteudo-error" class='text-danger invalid-feedback' style="display: none"></label>
                            </div>

                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4">
                            <!-- Tags -->
                            <div class="form-group col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <hr>
                                <label class="text-input">Tag *</label>
                            </div>
                            <div class="form-group row col-sm-12 col-md-12 col-lg-12 col-xl-12 ml-1">
                                @if (!empty($tags))
                                @foreach ($tags as $tag)
                                <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3 form-check">
                                    <input type="checkbox" class="form-check-input" name="tag[]" id="tag{{ $tag->id }}" value="{{ $tag->id }}" {{ in_array($tag->id,$listTag)  ? ' checked ' : '' }}>
                                    <label class="form-check-label" for="tag{{ $tag->id }}">{{ $tag->Slug }}</label>
                                </div>
                                @endforeach
                                @else
                                <option value="">Tag não encontrada</option>
                                @endif

                                <div class="invalid-feedback"></div>
                            </div>

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

                    <button type="button" onclick=location.href="{{ route('indexPost') }}" class="btn btn-secondary mr-3 mb-5 float-left">
                        <i class="fa fa-step-backward" aria-hidden="true"></i> Voltar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

@stop