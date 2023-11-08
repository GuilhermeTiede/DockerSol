@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Empresas')
@section('actualPage', 'Empresas')
@section('button', 'Nova Empresa')
@section('link', route('empresas.create'))
@section('content')
    <table id="empresasTable" class="data-table table stripe hover nowrap">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($empresas as $empresa)
            <tr>
                <td>{{ $empresa->nome }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('empresas.edit', ['empresa' => $empresa->id]) }}">Editar</a> |
                    <a class="btn btn-primary" href="{{ route('empresas.show', ['empresa' => $empresa->id]) }}">Visualizar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

@section('scripts')

@endsection
