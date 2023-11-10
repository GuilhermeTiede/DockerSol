@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Cadastrar Fonte Pagadora')
@section('actualPage', 'Cadastrar -> Fonte Pagadora')
@section('button', 'Voltar')
@section('link', route('fontespagadoras.index'))

@section('content')

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Casdastrar Fonte Pagadora</h4>
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

        <form id="editFontepagadora" action="{{route('fontespagadoras.store')}}" method="post">
            @csrf
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Nome do Titular</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="nomeTitular" placeholder="Nome do Titular">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Banco</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="banco" placeholder="Banco">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Agência</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="agencia" placeholder="Agência">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Conta</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="conta" placeholder="Conta">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Tipo da Conta</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="tipoConta" placeholder="Tipo da Conta">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 col-md-2"></div>
                <div class="col-sm-12 col-md-10">
                    <button type="submit" class="btn btn-primary">Cadastrar Conta</button>
                </div>
            </div>
        </form>
    </div>
@endsection

