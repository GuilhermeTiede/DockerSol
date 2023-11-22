@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Veiculos')
@section('actualPage', 'Veiculos')
@section('button', 'Novo Veiculo')
@section('link', route('veiculos.create'))
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

    <table id="clientesTable" class="data-table table stripe hover nowrap">
        <thead>
        <tr>
            <th class="table-plus datatable-nosort">Motorista</th>
            <th >Placa</th>
            <th class="datatable-nosort">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($veiculos as $veiculo)
            <tr>
                <td class="table-plus">{{$veiculo->motorista->nome}}</td>
                <td>{{ $veiculo->placa }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('veiculos.edit', ['veiculo' => $veiculo->id]) }}">Editar</a> |
                    <a class="btn btn-primary" href="{{ route('veiculos.show', ['veiculo' => $veiculo->id]) }}">Visualizar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
