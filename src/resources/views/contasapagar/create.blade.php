@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Contas a Pagar/Receber')
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
                <h4 class="text-blue h4">Cadastrar Conta</h4>
                <p class="mb-30">Edite os campos da Conta:</p>
            </div>
        </div>



        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="createConta" action="{{route('contasapagar.store')}}" method="post">
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
                <label class="col-sm-12 col-md-2 col-form-label">Selecione a Fonte Pagadora</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="id_fontePagadora">
                        <option value="" selected>Selecione a Fonte Pagadora</option>
                        @foreach($fontePagadoras as $fontePagadora)
                        <option value="{{$fontePagadora->id}}">{{$fontePagadora->nomeTitular}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Descricao</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="descricao" placeholder="Descricao">
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Valor</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" id="valorContas" name="valor" >
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Data de Vencimento</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control date-picker" type="text" name="dataVencimento">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Data de Pagamento</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control date-picker" type="text" name="dataPagamento">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Status</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="status">
                        <option value="" selected>Selecione o Status</option>
                        <option value="pendente">Pendente</option>
                        <option value="pago">Pago</option>
                        <option value="atrasado">Atrasado</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 col-md-10 offset-md-2">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>

        </form>

        <script>
            $(document).ready(function($) {
                // Selecione o campo 'valorOrdemServico' e aplique a máscara de moeda brasileira
                $('#valorContas').maskMoney({
                    prefix: 'R$ ',
                    thousands: '.',
                    decimal: ',',
                    allowZero: false,
                    showSymbol: true
                });

                // Adicione um evento de envio do formulário
                $('#createConta').submit(function(event) {
                    // Obtém o valor formatado do campo
                    var valorFormatado = $('#valorContas').val();

                    // Remove o prefixo 'R$ ' e substitui vírgulas por pontos
                    valorFormatado = valorFormatado.replace('R$ ', '').replace('', '');

                    // Define o valor formatado no campo
                    $('#valorContas').val(valorFormatado);

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
