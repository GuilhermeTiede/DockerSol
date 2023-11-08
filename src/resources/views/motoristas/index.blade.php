@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Motoristas')
@section('actualPage', 'Motoristas')
@section('button', 'Novo Motorista')
@section('link', route('motoristas.create'))
@section('content')

    <div class="container">
        @if (count($motoristas) > 0)
            <table id="motoristasTable" class="data-table table stripe hover">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Cpf</th>
                    <th>Categoria Cnh</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($motoristas as $motorista)
                    <tr>
                        <td>{{ $motorista->nome }}</td>
                        <td>{{ $motorista->cpf}}</td>
                        <td>{{ $motorista->categoriaCnh }}</td>
                        <td style="white-space: nowrap;">
                            <a href="{{ route('motoristas.show', ['motorista' => $motorista->id]) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('motoristas.edit', ['motorista' => $motorista->id]) }}"
                               class="btn btn-primary">Editar</a>
                            <form action="{{ route('motoristas.destroy', ['motorista' => $motorista->id]) }}"
                                  method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>Nenhuma ordem de servico encontrada.</p>
        @endif
    </div>
@endsection
