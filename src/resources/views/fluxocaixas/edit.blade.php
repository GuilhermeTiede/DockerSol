@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit Fluxo Caixa')
@section('actualPage', 'Edit -> Fluxo Caixa')
@section('button', 'Voltar')
@section('link', route('fluxocaixas.index'))
@section('content')

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Editar Fluxo de Caixa</h4>
                <p class="mb-30">Edite os campos do Fluxo de Caixa:</p>
            </div>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-danger">
                {{ session()->get('error') }}
            </div>
        @endif


        <form id="editFluxo" action="{{route('fluxocaixas.update',['fluxoCaixa'=>$fluxoCaixa->id])}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">



            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Ordem de Servico</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="id_ordemServico">
                        <option value="{{$fluxoCaixa->ordemServico->id}}">{{$fluxoCaixa->ordemServico->numeroOrdemServico}}</option>
                        @foreach($ordemServicos as $ordemServico)
                        <option value="{{$ordemServico->id}}">{{$ordemServico->numeroOrdemServico}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Fonte Pagadora</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="id_fontePagadora">
                        <option value="{{$fluxoCaixa->fontePagadora->id}}">{{$fluxoCaixa->fontePagadora->nomeTitular}}</option>
                        @foreach($fontePagadoras as $fontePagadora)
                            <option value="{{$fontePagadora->id}}">{{$fontePagadora->nomeTitular}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Tipo</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="tipo">
                        <option value="{{$fluxoCaixa->tipo}}">{{$fluxoCaixa->tipo}}</option>
                        <option value="entrada">Entrada</option>
                        <option value="saida">Saída</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Data Transação</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control date-picker" type="text" name="data" value="{{$fluxoCaixa->data}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Valor</label>
                <div class="col-sm-12 col-md-10">
                    @php
                        $valorFormatado = number_format($fluxoCaixa->valor,2,',','.');
                    @endphp
                    <input class="form-control" type="text" id="valor" name="valor" value="{{$valorFormatado}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Observacao</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="observacao" value="{{$fluxoCaixa->observacao}}">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 col-md-10 offset-md-2">
                    <button type="submit" class="btn btn-primary">Editar Fluxo Caixa</button>
                </div>
            </div>

        </form>

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
                $('#editFluxo').submit(function(event) {
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
