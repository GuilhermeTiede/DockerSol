@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Relatorio Fluxo de Caixa')
@section('actualPage', 'Relatório')
@section('button', 'Voltar')
@section('link', route('fluxocaixas.index'))


@section('content')
    <div class="container">
        <form action="{{ route('fluxocaixas.relatorios') }}" method="GET" class="form-inline">
            <div class="form-group">
                <label for="data_inicio" class="mr-2">Data de Início:</label>
                <input type="date" name="data_inicial" id="data_inicial" class="form-control" value="{{ isset($data_inicial) ? $data_inicial : '' }}">
            </div>
            <div class="form-group ml-2">
                <label for="data_fim" class="mr-2">Data de Fim:</label>
                <input type="date" name="data_final" id="data_final" class="form-control" value="{{ isset($data_final) ? $data_final : '' }}">
            </div>
            <div class="mt-4 ml-2">
                <button type="submit" class="btn btn-primary">Gerar Relatório</button>
            </div>
        </form>
    </div>

    <table class="table hover data-table-export nowrap">
        <thead>
        <tr>
            <th>Data Início</th>
            <th>Data Fim</th>
            <th>Total Saida</th>
            <th>Total Entrada</th>
            <th>Saldo</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ isset($data_inicial) ? \Carbon\Carbon::createFromFormat('Y-m-d', $data_inicial)->format('d/m/Y') : '' }}</td>
            <td>{{ isset($data_final) ? \Carbon\Carbon::createFromFormat('Y-m-d', $data_final)->format('d/m/Y') : '' }}</td>
            <td>{{ isset($totalSaida) ? 'R$ ' . number_format($totalSaida, 2, ',', '.') : '' }}</td>
            <td>{{ isset($totalEntrada) ? 'R$ ' . number_format($totalEntrada, 2, ',', '.') : '' }}</td>
            <td>{{ isset($saldo) ? 'R$ ' . number_format($saldo, 2, ',', '.') : '' }}</td>
        </tr>
        </tbody>
    </table>
@endsection

