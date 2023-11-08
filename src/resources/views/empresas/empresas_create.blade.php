@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Criar Empresas')
@section('actualPage', 'Criar -> Empresas')
@section('button', 'Voltar')
@section('link', route('empresas.index'))

@section('content')

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Criar Empresas</h4>
                <p class="mb-30">Edite os campos a empresa:</p>
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


        <form id="editEmpresa" action="{{route('empresas.store')}}" method="post">
            @csrf
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Nome</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="nome" placeholder="Nome da Empresa">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">CNPJ</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="cnpj" placeholder="CNPJ da Empresa">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Endereco</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="endereco" placeholder="Endereco da Empresa">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 col-md-2"></div>
                <div class="col-sm-12 col-md-10">
                    <button type="submit" class="btn btn-primary">Criar Empresa</button>
                </div>
            </div>
        </form>
    </div>
@endsection
