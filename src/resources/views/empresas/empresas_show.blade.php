@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Editar Empresas')
@section('actualPage', 'Editar -> Empresas')
@section('button', 'Voltar')
@section('link', route('empresas.index'))

@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    <h3>Empresa: {{$empresa->nome}}</h3>

    <form id="deleteEmpresa" action="{{route('empresas.destroy',['empresa'=>$empresa->id])}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Nome</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="nome" value="{{$empresa->nome}}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">CNPJ</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="cnpj" value="{{$empresa->cnpj}}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Endereco</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="endereco" value="{{$empresa->endereco}}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 col-md-2"></div>
            <div class="col-sm-12 col-md-10">
                <button type="submit" class="btn btn-danger">Deletar</button>
            </div>
        </div>
@endsection
