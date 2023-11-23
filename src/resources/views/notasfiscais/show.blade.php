@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Notas Ficais')
@section('actualPage', 'Notas Fiscais')
@section('button', 'Voltar')
@section('link', route('notasfiscais.index'))

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

        <form id="statusNota" action="{{ route('status.notafiscal', ['notafiscal' => $notafiscal->id]) }}" method="post">
            @csrf

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Contratos</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="id_contrato" id="id_contrato">
                        <option value="" disabled selected>Selecione Contratos</option>
                        @foreach($contratos as $contrato)
                            <option value="{{$contrato->id}}">{{$contrato->nomeContrato}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Ordem de Servico</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="id_ordemServico" id="id_ordemServico">
                        <option value="" disabled selected>Selecione a Os Correspondente</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Fonte Pagadora</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="id_fontePagadora">
                        <option value="" disabled selected>Selecione a Fonte Pagadora</option>
                        @foreach($fontePagadoras as $fontePagadora)
                            <option value="{{$fontePagadora->id}}">{{$fontePagadora->nomeTitular}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Data</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control date-picker" type="text" name="dataPagamento">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Status Nota</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="status">
                        <option value="" disabled selected>Selecione o Status</option>

                        <option value="Pago">Pago</option>
                        <option value="Pendente">Pendente</option>

                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-success">Salvar Status</button>
        </form>

    <form id="deleteNotafiscal" action="{{route('notasfiscais.destroy',['notafiscal'=>$notafiscal->id])}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">

        <div class="row">
            <div class="col-md-2 col-sm-2">
                <div class="form-group">
                <label class="col-form-label">Numero da Nota</label>
                <input class="form-control" type="text" name="numeroNf" value="{{$notafiscal->numeroNf}}" disabled>
                </div>
            </div>

            <div class="col-md-2 col-sm-2">
                <div class="form-group">
                <label class="col-form-label">Data Emissao</label>
                <input class="form-control" type="text" name="dataEmissao" value="{{$notafiscal->dataEmissao}}" disabled>
                </div>
            </div>

            <div class="col-md-2 col-sm-2">
                <label class="col-form-label">Previsão</label>
                <input type="text" class="form-control" name="dataPrevisaoPagamento" value="{{$notafiscal->dataPrevisaoPagamento}}" disabled />
            </div>

            <div class="col-md-2">
                <label class="col-form-label">Mes</label>
                <input class="form-control" type="text" name="mes" value="{{$notafiscal->mes}}" disabled>
            </div>

            <div class="col-md-2">
                <label class="col-form-label">Exercicio</label>
                <input class="form-control inputmoney" type="text" name="exercicio" value="{{$notafiscal->exercicio}}" disabled>
            </div>
            <div class="col-md-2">
                <label class="col-form-label font-weight-bolder">Valor Total</label>
                @php
                    $valorTotalFormatado = number_format($notafiscal->valorTotal, 2, ',', '.');
                @endphp
                <input class="form-control" type="text" name="valorTotal" value="R$ {{$valorTotalFormatado}}" disabled>
            </div>
        </div>

        <div class="row">

            <div class="col-md-2">
                <label class="col-form-label">Iss</label>
                <input class="form-control" type="text" name="valorIss" value="{{$notafiscal->valorIss}}" disabled>
            </div>

            <div class="col-md-2">
                <label class="col-form-label">Pis</label>
                <input class="form-control" type="text" name="valorPis" value="{{$notafiscal->valorPis}}" disabled>
            </div>

            <div class="col-md-2">
                <label class="col-form-label">Cofins</label>>
                <input class="form-control" type="text" name="valorCofins" value="{{$notafiscal->valorCofins}}" disabled>
            </div>

            <div class="col-md-2">
                <label class="col-form-label">Inss</label>
                <input class="form-control" type="text" name="valorInss" value="{{$notafiscal->valorInss}}" disabled>
            </div>

            <div class="col-md-2">
                <label class="col-form-label">Ir</label>
                <input class="form-control" type="text" name="valorIr" value="{{$notafiscal->valorIr}}" disabled>
            </div>

            <div class="col-md-2">
                <label class="col-form-label">Csll</label>
                <input class="form-control" type="text" name="valorCsll" value="{{$notafiscal->valorCsll}}" disabled>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <label class="col-form-label">Nome Prestador</label>
                <input class="form-control" type="text" name="descricao" value="{{$notafiscal->nome_prestador}}" disabled>
            </div>

            <div class="col-md-6">
                <label class="col-form-label">Cnpj Prestador</label>
                <input class="form-control" type="text" name="descricao" value="{{$notafiscal->cnpj_prestador}}" disabled>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label class="col-form-label">Nome Tomador</label>
                <input class="form-control" type="text" name="descricao" value="{{$notafiscal->nome_tomador}}" disabled>
            </div>

            <div class="col-md-6">
                <label class="col-form-label">Cnpj Tomador</label>
                <input class="form-control" type="text" name="descricao" value="{{$notafiscal->cnpj_tomador}}" disabled>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="col-form-label">Descrição</label>
                <textarea class="form-control" name="descricao" rows="4" disabled>{{$notafiscal->descricao}}</textarea>
            </div>
        </div>


                <button type="submit" class="btn btn-danger">Deletar Nota Fiscal</button>
    </form>

        <script>
            $(document).ready(function($) {
                // Selecione o campo 'valorOrdemServico' e aplique a máscara de moeda brasileira
                $('#valorFluxoCaixa').maskMoney({
                    prefix: 'R$ ',
                    thousands: '.',
                    decimal: ',',
                    allowZero: false,
                    showSymbol: true
                });

                // Adicione um evento de envio do formulário
                $('#createFluxoCaixa').submit(function(event) {
                    // Obtém o valor formatado do campo
                    var valorFormatado = $('#valorFluxoCaixa').val();

                    // Remove o prefixo 'R$ ' e substitui vírgulas por pontos
                    valorFormatado = valorFormatado.replace('R$ ', '').replace('', '');

                    // Define o valor formatado no campo
                    $('#valorFluxoCaixa').val(valorFormatado);

                    // Continua com o envio do formulário
                    return true;
                });

                // Adicione um evento de alteração do campo "Contratos"
                $('#id_contrato').change(function() {
                    var selectedContract = $(this).val();

                    // Aqui você pode fazer uma chamada AJAX para obter as Ordens de Serviço correspondentes ao contrato selecionado
                    $.ajax({
                        type: 'GET',
                        url: '/get-ordem-servico-por-contrato', // A rota que você configurou
                        data: { contrato_id: selectedContract },
                        success: function(data) {
                            var $osSelect = $('#id_ordemServico');
                            $osSelect.empty(); // Limpa o select atual

                            // Adiciona as novas opções de Ordens de Serviço
                            $osSelect.append($('<option>', {
                                value: '',
                                text: 'Selecione a Os Correspondente'
                            }));
                            $.each(data, function(key, value) {
                                $osSelect.append($('<option>', {
                                    value: value.id,
                                    text: value.numeroOrdemServico
                                }));
                            });
                        },
                        error: function() {
                            // Trate erros de requisição, se necessário
                        }
                    });
                });
            });
        </script>


    </div>

@endsection
