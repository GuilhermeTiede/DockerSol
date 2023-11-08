@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Contratos')
@section('actualPage', 'Contratos')
@section('button', 'Novo Contrato')
@section('link', route('contratos.create'))

@section('content')
    <div class="container">
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @endif

    <table id="contratos" class="data-table table stripe hover nowrap">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($contratos as $contrato)
            <tr>
                <td>{{ $contrato->nomeContrato }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('contratos.edit', ['contrato' => $contrato->id]) }}">Editar</a> |
                    <a class="btn btn-primary" href="{{ route('contratos.show', ['contrato' => $contrato->id]) }}">Visualizar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>

@endsection
