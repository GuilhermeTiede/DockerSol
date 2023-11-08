@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Create Clientes')
@section('actualPage', 'Create -> Ordens Servicos')
@section('button', 'Voltar')
@section('link', route('ordensservicos.index'))
@section('content')

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Criar Ordem de Serviço</h4>
                <p class="mb-30">Preencha os campos da Ordem de Serviço:</p>
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

        <form id="createOrdemServico" action="{{ route('ordensservicos.store') }}" method="post">
            @csrf

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Contrato</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="contrato_id">
                        <option value="" disabled selected>Selecione o Contrato</option>
                        @foreach($contratos as $contrato)
                            <option value="{{$contrato->id}}">{{$contrato->nomeContrato}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Valor</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="valorOrdemServico" name="valorOrdemServico">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Data de Ordem de Serviço</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control date-picker" type="text" name="dataOrdemServico"
                           placeholder="Data de Ordem de Serviço">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Número de Ordem de Serviço</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="numeroOrdemServico"
                           placeholder="Número de Ordem de Serviço">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 col-md-10 offset-md-2">
                    <button type="submit" class="btn btn-primary">Criar Ordem de Serviço</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function($) {
            // Selecione o campo 'valorOrdemServico' e aplique a máscara de moeda brasileira
            $('#valorOrdemServico').maskMoney({
                prefix: 'R$ ',
                thousands: '.',
                decimal: ',',
                allowZero: false,
                showSymbol: true
            });

            // Adicione um evento de envio do formulário
            $('#createOrdemServico').submit(function(event) {
                // Obtém o valor formatado do campo
                var valorFormatado = $('#valorOrdemServico').val();

                // Remove o prefixo 'R$ ' e substitui vírgulas por pontos
                valorFormatado = valorFormatado.replace('R$ ', '').replace('', '');

                // Define o valor formatado no campo
                $('#valorOrdemServico').val(valorFormatado);

                // Continua com o envio do formulário
                return true;
            });
        });
    </script>

@endsection
