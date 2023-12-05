@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Contas a Pagar')
@section('actualPage', 'Contas a Pagar')
@section('button', 'Cadastrar Conta')
@section('link', route('contasapagar.create'))
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

    <table id="clientesTable" class="data-table table stripe hover">
        <thead>
        <tr>
            <th>Contrato</th>
            <th>Ordem</th>
            <th>Descricao</th>

            <th >Valor</th>
            <th class="">Status</th>
            <th class="">Data de Vencimento</th>
            <th class="">Data de Pagamento</th>

            <th class="datatable-nosort">Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($contas as $conta)
            <tr>
                <td>{{$conta->ordemServico->contrato->nomeContrato}}</td>
                <td>{{$conta->ordemServico->numeroOrdemServico}}</td>
                <td>{{$conta->descricao}}</td>
                <td>
                    @php
                        $valorTotalFormatado = number_format($conta->valor, 2, ',', '.');

                    @endphp
                    {{ "R$".$valorTotalFormatado}}
                </td>
                <td>{{ $conta->status }}</td>
                <td>{{ $conta->dataVencimento }}</td>
                <td>{{ $conta->dataPagamento }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('contasapagar.edit', ['conta' => $conta->id]) }}">Editar</a>
                    <a class="btn btn-primary" href="{{ route('contasapagar.show', ['conta' => $conta->id]) }}">Vizualizar</a> |
                    <form id="delete-form-{{$conta->id}}" action="{{ route('contasapagar.destroy', ['conta' => $conta->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Excluir</button>
                    </form>
                    <form id="update-form-{{$conta->id}}" action="{{ route('contasapagar.mudarstatus', ['conta' => $conta->id]) }}" method="POST" style="display: inline;">
                        @csrf
                        <input type="hidden" name="status" value="pago">
                        <button type="submit" class="btn btn-info">Pago</button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
