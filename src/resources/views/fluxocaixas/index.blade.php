@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Fluxo de Caixa')
@section('actualPage', 'Fluxo de Caixa')
@section('button', 'Cadastro de Fluxo de Caixa')
@section('link', route('fluxocaixas.create'))

@section('content')

        <div class="container">
            <form action="{{ route('fluxocaixas.index') }}" method="GET">
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

            @if (count($fluxoCaixas) > 0)
                <table id="fluxoCaixasTable" class="data-table table stripe hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Contrato</th>
                        <th>Os</th>
                        <th>Data</th>
                        <th>Fonte</th>
                        <th>Valor</th>
                        <th>Tipo</th>
                        <th>Observacao</th>
                        <th>Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($fluxoCaixas as $fluxoCaixa)
                        <tr>
                            <td>{{ $fluxoCaixa->id }}</td>
                           <td>{{ $fluxoCaixa->ordemServico->contrato->nomeContrato }}</td>
                            <td>{{ $fluxoCaixa->ordemServico->numeroOrdemServico}}</td>
                            <td>{{ $fluxoCaixa->data }}</td>
                            <td>{{ $fluxoCaixa->fontePagadora->nomeTitular }}</td>
                            <td>
                                @php
                                $valorFormatado = number_format($fluxoCaixa->valor,2,',','.');
                                @endphp
                                {{"R$ $valorFormatado"}}
                            </td>
                            <td>{{ $fluxoCaixa->tipo }}</td>
                            <td>{{ $fluxoCaixa->observacao }}</td>
                            <td>
{{--                                <a href="{{ route('fluxocaixas.show', ['fluxoCaixa' => $fluxoCaixa->id]) }}" class="btn btn-info">Ver</a>--}}
                                <a href="{{ route('fluxocaixas.edit', ['fluxoCaixa' => $fluxoCaixa->id]) }}"
                                   class="btn btn-primary">Editar</a>
                                <form action="{{ route('fluxocaixas.destroy', ['fluxoCaixa' => $fluxoCaixa->id]) }}"
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

        </div>

            @else
                <p>Nenhum fluxo de caixa encontrado.</p>
            @endif
@endsection
