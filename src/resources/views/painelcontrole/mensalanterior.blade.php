@extends('layouts.page-layout')
@section('pageTitle', 'Painel de Controle Mensal Anterior')
@section('actualPage', 'Painel de Controle Mensal Anterior')
@section('button', 'Ano de 2024')
@section('link', route('painelcontrole.mensal'))
@section('content')
    <table class="table hover data-table-export nowrap">
        <thead>
        <tr>
            <th>Mês</th>
            <th>Ano</th>
            <th>Faturamento</th>
            <th>Recebimento</th>
            <th>Despesas</th>
            <th>Administração</th>
            <th>% Administração</th>
            <th>Retirada</th>
            <th>% Retirada</th>
            <th>Investimento</th>
            <th>% Investimento</th>
            <th>Impostos Pagos</th>
            <th>% Impostos Pagos</th>
            <th>Impostos Retidos</th>
            <th>% Impostos Retidos</th>
            <th>% Total Impostos</th>
            <th>Lucro</th>
        </tr>
        </thead>
        <tbody>
        @foreach($dadosFinanceirosAnterior as $financeiroAnterior)
            <tr>
                <td>{{$financeiroAnterior->mes }}</td>
                <td>{{ $financeiroAnterior->ano }}</td>
                <td>R$ {{ number_format($financeiroAnterior->faturamento, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($financeiroAnterior->recibemento, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($financeiroAnterior->despesas, 2, ',', '.') }}</td>
                <td>R$ {{ number_format($financeiroAnterior->adm, 2, ',', '.') }}</td>
                <td>{{ number_format($financeiroAnterior->percentual_adm, 2, ',', '.') }}%</td>
                <td>R$ {{ number_format($financeiroAnterior->retirada, 2, ',', '.') }}</td>
                <td>{{ number_format($financeiroAnterior->percentual_retirada, 2, ',', '.') }}%</td>
                <td>R$ {{ number_format($financeiroAnterior->investimento, 2, ',', '.') }}</td>
                <td>{{ number_format($financeiroAnterior->percentual_investimento, 2, ',', '.') }}%</td>
                <td>R$ {{ number_format($financeiroAnterior->impostos_pagos, 2, ',', '.') }}</td>
                <td>{{ number_format($financeiroAnterior->percentual_impostos_pagos, 2, ',', '.') }}%</td>
                <td>R$ {{ number_format($financeiroAnterior->impostos_retidos, 2, ',', '.') }}</td>
                <td>{{ number_format($financeiroAnterior->percentual_impostos_retidos, 2, ',', '.') }}%</td>
                <td>{{ number_format($financeiroAnterior->soma_percentual_impostos, 2, ',', '.') }}%</td>
                <td>R$ {{ number_format($financeiroAnterior->lucro, 2, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
