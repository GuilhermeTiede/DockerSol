@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Relatorio Contas a Pagar')
@section('actualPage', 'Relatório')
@section('button', 'Voltar')
@section('link', route('contasapagar.index'))
<!-- resources/views/contasapagar/exibirrelatorio.blade.php -->



@section('content')
    <div class="container">
        <form action="{{ route('contasapagar.relatorios') }}" method="GET" class="form-inline">
            <div class="form-group">
                <label for="data_inicial" class="mr-2">Data de Início:</label>
                <input type="date" name="data_inicial" id="data_inicial" class="form-control" value="{{ isset($data_inicial) ? $data_inicial : '' }}">
            </div>
            <div class="form-group ml-2">
                <label for="data_final" class="mr-2">Data de Fim:</label>
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
            <th>Total Pendente</th>
            <th>Total Atrasado</th>
        </tr>
        </thead>
        <tbody>

                <tr>
                    <td>{{ isset($data_inicial) ? \Carbon\Carbon::createFromFormat('Y-m-d', $data_inicial)->format('d/m/Y') : '' }}</td>
                    <td>{{ isset($data_final) ? \Carbon\Carbon::createFromFormat('Y-m-d', $data_final)->format('d/m/Y') : '' }}</td>
                    <td>{{ isset($totalPendentes) ? 'R$ ' . number_format($totalPendentes, 2, ',', '.') : '' }}</td>
                    <td>{{ isset($totalAtrasados) ? 'R$ ' . number_format($totalAtrasados, 2, ',', '.') : '' }}</td>
                </tr>

        </tbody>
    </table>


@endsection

