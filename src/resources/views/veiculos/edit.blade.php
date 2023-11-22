@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Editar Veiculo')
@section('actualPage', 'Editar -> Veiculo')
@section('button', 'Voltar')
@section('link', route('veiculos.index'))

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

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Editar Veiculo</h4>
                <p class="mb-30">Edite os campos de Veiculo:</p>
            </div>
        </div>
        <form id="createVeiculos" action="{{route('veiculos.update',['veiculo'=>$veiculo->id])}}" method="post">
            @csrf

            <input type="hidden" name="_method" value="PUT">
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Motorista</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="motorista_id">
                        <option value="{{$veiculo->motorista->id}}">{{$veiculo->motorista->nome}}</option>
                        @foreach($motoristas as $motorista)
                            <option value="{{ $motorista->id }}">{{ $motorista->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Placa</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="placa" value="{{$veiculo->placa}}" maxlength="7">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Renavam</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="renavam" value="{{$veiculo->renavam}}" maxlength="11">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Chassi</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="chassi" value="{{$veiculo->chassi}}" maxlength="17">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Modelo</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="modelo" value="{{$veiculo->modelo}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Marca</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="marca" value="{{$veiculo->marca}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Ano</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="ano" value="{{$veiculo->ano}}">

                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Cor</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="cor" value="{{$veiculo->cor}}">

                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Tipo do Combustível</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="tipoCombustivel">
                        <option value="{{$veiculo->tipoCombustivel}}">{{$veiculo->tipoCombustivel}}</option>
                        <option value="Gasolina">Gasolina</option>
                        <option value="Etanol">Etanol</option>
                        <option value="Diesel">Diesel</option>
                        <option value="GNV">GNV</option>
                        <option value="Flex">Flex</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Tipo do Veículo</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="tipoVeiculo" value="{{$veiculo->tipoVeiculo}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Categoria do Veículo</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="categoriaVeiculo">
                        <option value="{{$veiculo->categoriaVeiculo}}">{{$veiculo->categoriaVeiculo}}</option>
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
                    <button type="submit" class="btn btn-primary">Atualizar Veiculo</button>
                </div>
            </div>

        </form>

    </div>
@endsection
