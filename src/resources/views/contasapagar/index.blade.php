@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Contas a Pagar')
@section('actualPage', 'Contas a Pagar')
@section('button', 'Cadastrar Conta')
@section('link', route('contasapagar.create'))
@section('content')

    <div class="container">

    <form action="{{ route('contasapagar.index') }}" method="GET">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="contrato">Filtrar por Contrato:</label>
                <select name="contrato" id="contrato" class="form-control">
                    <option value="">Todos</option>
                    @foreach ($contratos as $contrato)
                        <option value="{{ $contrato->id }}">{{ $contrato->nomeContrato }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="ordem_servico">Filtrar por Os:</label>
                <select name="ordem_servico" id="ordem_servico" class="form-control">
                    <option value="">Todas</option>
                    @foreach ($ordemServicos as $ordemServico)
                        <option value="{{ $ordemServico->id }}">{{ $ordemServico->numeroOrdemServico }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label for="data_inicio">Data de Início:</label>
                <input type="date" name="data_inicio" id="data_inicio" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <label for="data_fim">Data de Fim:</label>
                <input type="date" name="data_fim" id="data_fim" class="form-control">
            </div>
            <div class="mt-4 ml-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>


{{--    <form action="{{ route('contasapagar.exibirrelatorio') }}" method="GET">--}}
{{--        <button type="submit" class="btn btn-primary">Acessar Relatórios</button>--}}
{{--    </form>--}}

        @if (count($contasApagar) > 0)
    <table id="clientesTable" class="data-table table stripe hover">
        <thead>
        <tr>
            <th>ID</th>
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
        @foreach ($contasApagar as $conta)
            <tr>
                <td>{{$conta->id}}</td>
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

        <tfoot>
        <tr>
            <td colspan="4"></td> <!-- Colunas vazias para alinhar com as outras -->
            <td><strong>Total:</strong></td>
            <td><strong>R$ {{ number_format($somaContasApagar, 2, ',', '.') }}</strong></td>
            <td colspan="3"></td> <!-- Colunas vazias para alinhar com as outras -->
        </tr>
        </tfoot>
    </table>
    </div>

    @else
        <p>Nenhum contas a pagar encontrado.</p>
    @endif
@endsection
