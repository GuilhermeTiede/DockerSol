@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Clientes')
@section('actualPage', 'Clientes')
@section('button', 'Novo Cliente')
@section('link', route('clientes.create'))
@section('content')

    <table id="clientesTable" class="data-table table stripe hover nowrap">
        <thead>
        <tr>
            <th class="table-plus datatable-nosort">Responsável</th>
            <th >Empresa</th>
            <th class="datatable-nosort">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($clientes as $cliente)
            <tr>
                <td class="table-plus">{{$cliente->empresa->nome}}</td>
                <td>{{ $cliente->nome }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('clientes.edit', ['cliente' => $cliente->id]) }}">Editar</a> |
                    <a class="btn btn-primary" href="{{ route('clientes.show', ['cliente' => $cliente->id]) }}">Visualizar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
