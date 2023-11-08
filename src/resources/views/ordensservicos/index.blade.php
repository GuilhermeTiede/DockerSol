@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Ordem de Servico')
@section('actualPage', 'Ordem de Servico')
@section('button', 'Nova Ordem de Servico')
@section('link', route('ordensservicos.create'))
@section('content')
    <div class="container">
        @if (count($ordensServico) > 0)
            <table id="ordensServicoTable" class="data-table table stripe hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Contrato</th>
                    <th>Número</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($ordensServico as $ordem)
                    <tr>
                        <td>{{ $ordem->id }}</td>
                        <td>{{ $ordem->contrato->nomeContrato }}</td>
                        <td>{{ $ordem->numeroOrdemServico }}</td>
                        <td>
                            @php
                            $valorFormatado = number_format($ordem->valorOrdemServico,2,',','.');
                            @endphp
                            {{"R$ $valorFormatado"}}
                        </td>
                        <td>{{ $ordem->dataOrdemServico }}</td>
                        <td style="white-space: nowrap;">
                            <a href="{{ route('ordensservicos.show', ['ordemServico' => $ordem->id]) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('ordensservicos.edit', ['ordemServico' => $ordem->id]) }}"
                               class="btn btn-primary">Editar</a>
                            <form action="{{ route('ordensservicos.destroy', ['ordemServico' => $ordem->id]) }}"
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
