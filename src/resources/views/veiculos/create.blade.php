@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Cadastrar Veiculos')
@section('actualPage', 'Cadastrar -> Veiculos')
@section('button', 'Voltar')
@section('link', route('veiculos.index'))
@section('content')

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Cadastrar Veiculo</h4>
                <p class="mb-30">Edite os campos de Veiculo:</p>
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

        <form id="createVeiculos" action="{{route('veiculos.store')}}" method="post">
            @csrf

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Motorista</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="id_motorista">
                        <option value="" disabled selected>Selecione o Motorista</option>
                        @foreach($motoristas as $motorista)
                            <option value="{{ $motorista->id }}">{{ $motorista->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Placa</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="placa" placeholder="Placa" maxlength="7">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Renavam</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="renavam" placeholder="Renavam" maxlength="11">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Chassi</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="chassi" placeholder="Chassi" maxlength="17">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Modelo</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="modelo" placeholder="Modelo">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Marca</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="marca" placeholder="Marca">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Ano</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="ano" placeholder="Ano">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Cor</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="cor" placeholder="Cor">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Tipo do Combustível</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="tipoCombustivel">
                        <option value="" disabled selected>Selecione a Categoria</option>
                        <option value="A">Gasolina</option>
                        <option value="B">Etanol</option>
                        <option value="AB">Diesel</option>
                        <option value="C">GNV</option>
                        <option value="D">Flex</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Tipo do Veículo</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="tipoVeiculo" placeholder="Tipo do Veículo">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Categoria do Veículo</label>
                <div class="col-sm-12 col-md-10">
                                        <select class="form-control" name="categoriaVeiculo">
                                            <option value="" disabled selected>Selecione a Categoria</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                            <option value="D">D</option>
                                            <option value="E">E</option>
                                        </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 col-md-2"></div>
                <div class="col-sm-12 col-md-10">
                    <button type="submit" class="btn btn-primary">Cadastrar Veiculo</button>
                </div>
            </div>

        </form>


    </div>

@endsection
