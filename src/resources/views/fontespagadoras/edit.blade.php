@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Editar Fonte Pagadora')
@section('actualPage', 'Editar -> Fonte Pagadora')
@section('button', 'Voltar')
@section('link', route('fontespagadoras.index'))

@section('content')


    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Editar Fonte Pagadora</h4>
                <p class="mb-30">Edite os campos da Fonte Pagadora:</p>
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

    <form id="deleteEmpresa" action="{{route('fontespagadoras.update',['fontepagadora'=>$fontepagadora->id])}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Nome do Titular</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="nomeTitular" value = "{{$fontepagadora->nomeTitular}}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Banco</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="banco" value = "{{$fontepagadora->banco}}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Agência</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="agencia" value = "{{$fontepagadora->agencia}}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Conta</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="conta" value = "{{$fontepagadora->conta}}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Tipo da Conta</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="tipoConta" value = "{{$fontepagadora->tipoConta}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 col-md-2"></div>
            <div class="col-sm-12 col-md-10">
                <button type="submit-" class="btn btn-primary">Editar Conta</button>
            </div>
        </div>
    </form>
    </div>
@endsection
