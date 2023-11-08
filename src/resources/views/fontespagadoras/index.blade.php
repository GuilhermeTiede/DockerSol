@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Fontes Pagadoras')
@section('actualPage', 'Fontes Pagadoras')
@section('button', 'Nova Fonte Pagadora')
@section('link', route('fontespagadoras.create'))

@section('content')
    <table id="fontespagadoras" class="data-table table stripe hover nowrap">
        <thead>
        <tr>
            <th>Nome</th>
            <th>Conta</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($fontespagadoras as $fontepagadora)
            <tr>
                <td>{{ $fontepagadora->nomeTitular }}</td>
                <td>{{$fontepagadora->conta}}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('fontespagadoras.edit', ['fontepagadora' => $fontepagadora->id]) }}">Editar</a> |
                    <a class="btn btn-primary" href="{{ route('fontespagadoras.show', ['fontepagadora' => $fontepagadora->id]) }}">Visualizar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
