@extends('layouts.page-layout')
@section('pageTitle', 'Painel de Controle Mensal')
@section('actualPage', 'Painel de Controle Mensal')
@section('button', 'Ano de 2023')
@section('link', route('painelcontrole.mensalanterior'))

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

            @foreach($dadosFinanceiros as $financeiro)
                <tr>
                    <td>{{ $financeiro->mes }}</td>
                    <td>{{ $financeiro->ano }}</td>
                    <td>R$ {{ number_format($financeiro->faturamento, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($financeiro->recibemento, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($financeiro->despesas, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($financeiro->adm, 2, ',', '.') }}</td>
                    <td>{{ number_format($financeiro->percentual_adm, 2, ',', '.') }}%</td>
                    <td>R$ {{ number_format($financeiro->retirada, 2, ',', '.') }}</td>
                    <td>{{ number_format($financeiro->percentual_retirada, 2, ',', '.') }}%</td>
                    <td>R$ {{ number_format($financeiro->investimento, 2, ',', '.') }}</td>
                    <td>{{ number_format($financeiro->percentual_investimento, 2, ',', '.') }}%</td>
                    <td>R$ {{ number_format($financeiro->impostos_pagos, 2, ',', '.') }}</td>
                    <td>{{ number_format($financeiro->percentual_impostos_pagos, 2, ',', '.') }}%</td>
                    <td>R$ {{ number_format($financeiro->impostos_retidos, 2, ',', '.') }}</td>
                    <td>{{ number_format($financeiro->percentual_impostos_retidos, 2, ',', '.') }}%</td>
                    <td>{{ number_format($financeiro->soma_percentual_impostos, 2, ',', '.') }}%</td>
                    <td>R$ {{ number_format($financeiro->lucro, 2, ',', '.') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

@endsection
