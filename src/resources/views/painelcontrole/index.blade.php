@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Painel de Controle')
@section('actualPage', 'Painel de Controle')
@section('button', 'Painel de Controle Mensal')
@section('link', route('painelcontrole.mensal'))
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif

    <div class="container">
{{--class="data-table table stripe hover--}} {{-- ou -> table hover data-table-export nowrap --}}
    <table id="painelTable" class="data-table table stripe hover">
        <thead>
        <tr>
            <th>Cliente</th>
            <th>Contrato</th>
            <th>Despesas</th>
            <th>Recebimento</th>
            <th>A Receber Previsão</th>
            <th>Valor NF Emitida</th>
            <th>Lucro</th>
            <th>Faturamento Total</th>
            <th>Margem de Lucro (%)</th>
            <th>Valor a Receber</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($dadosPainel as $dados)
            <tr>
                <td>{{ $dados['cliente'] }}</td>
                <td>{{ $dados['contrato'] }}</td>
                <td>{{ "R$ " . number_format($dados['despesas'], 2, ',', '.') }}</td>
                <td>{{ "R$ " . number_format($dados['recebimento'], 2, ',', '.') }}</td>
                <td>{{ "R$ " . number_format($dados['a_receber_previsao'], 2, ',', '.') }}</td>
                <td>{{ "R$ " . number_format($dados['valor_nf_emitida'], 2, ',', '.') }}</td>
                <td>{{ "R$ " . number_format($dados['lucro'], 2, ',', '.') }}</td>
                <td>{{ "R$ " . number_format($dados['faturamento_total'], 2, ',', '.') }}</td>
                <td>{{ number_format($dados['margem_lucro'], 2, ',', '.') . "%" }}</td>
                <td>
                    <form id="painelupdate" action="{{ route('painelcontrole.update', ['contrato' => $dados['id']]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input class="form-control" type="text" id="a_receber_previsao" name="a_receber_previsao" value="{{$dados['a_receber_previsao']}}">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Tem certeza que deseja atualizar?')">Atualizar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>

@endsection
