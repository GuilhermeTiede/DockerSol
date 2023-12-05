@php use Carbon\Carbon; @endphp
@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Contas a Pagar')
@section('actualPage', 'Contas a Pagar')
@section('button', 'Voltar')
@section('link', route('contasapagar.index'))
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

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Vizualizar Conta</h4>
                <p class="mb-30">Anexe Documento:</p>
            </div>
        </div>

        <form method="POST" action="{{route('upload.documento')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="formFile"  class="col-sm-12 col-md-2 col-form-label">Anexar Documento</label>
                <div class="col-sm-12 col-md-10">
                    <label><input type="hidden" name="contrato_id" value="{{$conta->ordemServico->contrato->id }}">
                        <input class="form-control-file" type="file" name="documento">
                    </label>
                    <button type="submit" class="btn btn-primary">Anexar</button>
                </div>
            </div>
        </form>


        <form id="editConta" action="{{route('contasapagar.update',['conta'=>$conta->id])}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Ordem de Servico</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="id_ordemServico" disabled>
                        <option value="{{$conta->ordemServico->id}}">{{$conta->ordemServico->numeroOrdemServico}}</option>
                        @foreach($ordemServicos as $ordemServico)
                            <option value="{{$ordemServico->id}}">{{$ordemServico->numeroOrdemServico}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Fonte Pagadora</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="id_fontePagadora" disabled>
                        <option value="{{$conta->fontePagadora->id}}">{{$conta->fontePagadora->conta}}</option>
                        @foreach($fontePagadoras as $fontePagadora)
                            <option value="{{$fontePagadora->id}}">{{$fontePagadora->conta}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Descricao</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="descricao" value="{{$conta->descricao}}" disabled>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Valor</label>
                <div class="col-sm-12 col-md-10">
                    @php
                        $valorFormatado = number_format($conta->valor,2,',','.');
                    @endphp
                    <input class="form-control" type="text" id="valor"  name="valor" value="{{$valorFormatado}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Data de Vencimento</label>
                <div class="col-sm-12 col-md-10">
                    <input
                        class="form-control date-picker"
                        type="text"
                        name="dataVencimento"
                        value="{{$conta->dataVencimento}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Data de Pagamento</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control date-picker" type="text" name="dataPagamento"
                           placeholder="{{$conta->dataPagamento}}" value="{{$conta->dataPagamento}}" disabled>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Status</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="status" disabled>
                        <option value="{{$conta->status}}">{{$conta->status}}</option>
                        <option value="pendente">Pendente</option>
                        <option value="pago">Pago</option>
                        <option value="atrasado">Atrasado</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 col-md-10 offset-md-2">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </div>

        </form>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nome do Documento</th>
                <th>Data Documento Adicionado</th>
                <th>Tipo do Documento</th>
                <th>Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($conta->ordemServico->contrato->documentoscontrato as $documento)
                <tr>
                    <td>{{ $documento->nomeDocumento }}</td>
                    <td>{{ $documento->dataDocumento }}</td>
                    <td>{{ $documento->tipoDocumento }}</td>
                    <td>
                        <a href="{{ url('uploads/' . $documento->nomeDocumento) }}" class="btn btn-primary" download>Baixar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <script>
            $(document).ready(function($) {
                // Selecione o campo 'valorOrdemServico' e aplique a máscara de moeda brasileira
                $('#valor').maskMoney({
                    prefix: 'R$ ',
                    thousands: '.',
                    decimal: ',',
                    allowZero: false,
                    showSymbol: true
                });

                // Adicione um evento de envio do formulário
                $('#editConta').submit(function(event) {
                    // Obtém o valor formatado do campo
                    var valorFormatado = $('#valor').val();

                    // Remove o prefixo 'R$ ' e substitui vírgulas por pontos
                    valorFormatado = valorFormatado.replace('R$ ', '').replace('', '');

                    // Define o valor formatado no campo
                    $('#valor').val(valorFormatado);

                    // Continua com o envio do formulário
                    return true;
                });
            });
        </script>
    </div>
@endsection
