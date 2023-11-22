@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vizualizar Fonte Pagadora')
@section('actualPage', 'Vizualizar -> Fonte Pagadora')
@section('button', 'Voltar')
@section('link', route('fontespagadoras.index'))

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
    <h3>Conta: {{$fontepagadora->nomeTitular}}</h3>

    <form id="deleteEmpresa" action="{{route('fontespagadoras.destroy',['fontepagadora'=>$fontepagadora->id])}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Nome do Titular</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="nomeTitular" value = "{{$fontepagadora->nomeTitular}}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Banco</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="banco" value = "{{$fontepagadora->banco}}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Agência</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="agencia" value = "{{$fontepagadora->agencia}}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Conta</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="conta" value = "{{$fontepagadora->conta}}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Tipo da Conta</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="tipoConta" value = "{{$fontepagadora->tipoConta}}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 col-md-2"></div>
            <div class="col-sm-12 col-md-10">
                <button type="submit-" class="btn btn-danger">Deletar Conta</button>
            </div>
        </div>
    </form>
@endsection
