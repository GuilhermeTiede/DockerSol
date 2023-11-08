@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Motoristas')
@section('actualPage', 'Cadastrar -> Motoristas')
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

        <form id="createMotorista" action="{{ route('motoristas.store') }}" method="post">
            @csrf

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Motorista</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="nome" name="nome" placeholder="Digite o nome completo do Motorista">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Cpf</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="cpf" name="cpf" placeholder="Digite Somente os Números">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Rg</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="rg" name="rg" placeholder="Digite Somente os Números">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Número da CNH</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="cnh" name="cnh" placeholder="Digite Somente os Números">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Categoria da Cnh</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="categoriaCnh">
                        <option value="" disabled selected>Selecione a Categoria</option>
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
                    <input class="form-control" type="text" id="endereco" name="endereco" placeholder="Digite o Endereço Completo">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Telefone</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="telefone" name="telefone" placeholder="Digite o Telefone">
                </div>
            </div>


            <div class="form-group row">
                <div class="col-sm-12 col-md-10 offset-md-2">
                    <button type="submit" class="btn btn-primary">Cadastrar Motorista</button>
                </div>
            </div>
        </form>
    </div>



@endsection
