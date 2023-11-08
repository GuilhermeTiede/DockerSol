@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Motoristas')
@section('actualPage', 'Vizualizar -> Motorista')
@section('button', 'Voltar')
@section('link', route('motoristas.index'))
@section('content')

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Cadastrar Motorista</h4>
                <p class="mb-30">Preencha os campos do Motorista:</p>
            </div>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif

        <form id="editMotorista" action="{{ route('motoristas.update', ['motorista' => $motorista->id]) }}" method="post">
            @csrf

            <input type="hidden" name="_method" value="PUT">

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Motorista</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="nome" name="nome" value="{{$motorista->nome}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Cpf</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="cpf" name="cpf" value="{{$motorista->cpf}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Rg</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="rg" name="rg"  value="{{$motorista->rg}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Número da CNH</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="cnh" name="cnh"  value="{{$motorista->cnh}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Categoria da Cnh</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="categoriaCnh" disabled>
                        <option  value="{{$motorista->categoriaCnh}}" selected>{{$motorista->categoriaCnh}}</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Endereço</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="endereco" name="endereco" value="{{$motorista->endereco}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Telefone</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="telefone" name="telefone" value="{{$motorista->telefone}}" disabled>
                </div>
            </div>
        </form>
    </div>


@endsection
