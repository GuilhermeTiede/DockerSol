@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vizualizar Veiculos')
@section('actualPage', 'Vizualizar -> Veiculos')
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
                <h4 class="text-blue h4">Excluir Veículo</h4>
            </div>
        </div>
        <form id="deleteVeiculos" action="{{route('veiculos.destroy',['veiculo'=>$veiculo->id])}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="DELETE">

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Motorista</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="motorista_id" disabled>
                        <option value="{{$veiculo->motorista->id}}"> {{$veiculo->motorista->nome}}</option>

                        @foreach($motoristas as $motorista)
                            <option value="{{ $motorista->id}}">{{ $motorista->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Placa</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="placa" value="{{$veiculo->placa}}" disabled>
                </div>
            </div>

            <div class="form-group row" >
                <label class="col-sm-12 col-md-2 col-form-label">Renavam</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="renavam" value="{{$veiculo->renavam}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Chassi</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="chassi" value="{{$veiculo->chassi}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Modelo</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="modelo" value="{{$veiculo->modelo}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Marca</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="marca" value="{{$veiculo->marca}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Ano</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="ano" value="{{$veiculo->ano}}" disabled>

                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Cor</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="cor" value="{{$veiculo->cor}}" disabled>

                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Tipo do Combustível</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="tipoCombustivel" disabled>
                        <option value="{{$veiculo->tipoCombustivel}}">{{$veiculo->tipoCombustivel}}</option>
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
                    <input class="form-control" type="text" name="tipoVeiculo" value="{{$veiculo->tipoVeiculo}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Categoria do Veículo</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="categoriaVeiculo" disabled>
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
                    <button type="submit" class="btn btn-danger">Deletar Veiculo</button>
                </div>
            </div>


        </form>

    </div>
@endsection
