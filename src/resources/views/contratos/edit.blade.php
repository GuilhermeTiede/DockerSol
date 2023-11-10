@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Editar Contratos')
@section('actualPage', 'Editar -> Contrato')
@section('button', 'Voltar')
@section('link', route('contratos.index'))
<script src="{{asset('back/src/scripts/jquery.min.js')}}"></script>
<!-- Inclua o script da biblioteca Inputmask -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>



@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Editar Contratos</h4>
                <p class="mb-30">Edite os campos do Contrato:</p>
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

        <form id="editContrato" action="{{route('contratos.update',['contrato'=>$contrato->id])}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Cliente</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="cliente_id">
                        <option value="{{ $contrato->cliente->id }}" selected>{{ $contrato->cliente->nome }}</option>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">NomeContrato</label>
                <div class="col-sm-12 col-md-10">
                    <label>
                        <input class="form-control" type="text" name="nomeContrato" placeholder="Nome do Contrato" value="{{$contrato->nomeContrato}}">
                    </label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Numero</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="numeroContrato" placeholder="Numero do Contrato" value="{{$contrato->numeroContrato}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Data Início:</label>
                <div class="col-sm-12 col-md-10">
                    <input
                        type="text"
                        class="form-control date-picker"
                        name="dataInicio"
                        @php
                           $dataFormatada =  \Carbon\Carbon::parse($contrato->dataInicio)->format('Y-m-d') ;
                        @endphp
                        value="{{$dataFormatada}}"
                    />
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Data Fim</label>
                <div class="col-sm-12 col-md-10">
                    @php
                        $dataFimFormatada =  \Carbon\Carbon::parse($contrato->dataFim)->format('Y-m-d') ;
                    @endphp
                    <input class="form-control date-picker"
                           type="text"
                           name="dataFim"
                           value="{{$dataFimFormatada}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Valor do Contrato</label>
                <div class="col-sm-12 col-md-10">
                    @php
                        $valorFormatado = number_format($contrato->valorContrato,2,',','.');
                    @endphp
                    <input class="form-control" type="text" id="valorContrato" name="valorContrato" value="{{$valorFormatado}}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Seguro Garantia</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="seguroGarantia" value="{{$contrato->seguroGarantia}}" placeholder="Tem seguro Garantia?">
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Responsabilidade Tecnica</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="responsabilidadeTecnica" value="{{$contrato->responsabilidadeTecnica}}" placeholder="ART foram concluidas?">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Observacao</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="observacao" value="{{$contrato->observacao}}" placeholder="ART foram concluidas?">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Contrato renovado?</label>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="renovado" id="renovadoSim" value="1" {{ $contrato->renovado == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="renovadoSim">
                        Sim
                    </label>
                </div>
                <div class="form-check-inline">
                    <input class="form-check-input" type="radio" name="renovado" id="renovadoNao" value="0" {{ $contrato->renovado == 0 ? 'checked' : '' }}>
                    <label class="form-check-label" for="renovadoNao">
                        Não
                    </label>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Data Renovação</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control date-picker" type="text" name="dataRenovacao" value="{{$contrato->dataRenovacao}}" placeholder="Data renovação" disabled>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-12 col-md-2"></div>
                <div class="col-sm-12 col-md-10">
                    <button type="submit" class="btn btn-primary">Editar Contrato</button>
                </div>
            </div>


        </form>

{{--        <script>--}}
{{--            $(document).ready(function() {--}}
{{--                // Inicializa o DatePicker--}}
{{--                $(".date-picker").datepicker({--}}
{{--                    dateFormat: 'yy-mm-dd', // Formato de data: ano-mês-dia--}}
{{--                    changeMonth: true,--}}
{{--                    changeYear: true,--}}
{{--                    onSelect: function (dateText, inst) {--}}
{{--                        // Ao selecionar uma data, atualize o valor do campo com a data selecionada--}}
{{--                        $(this).val(dateText);--}}
{{--                    }--}}
{{--                });--}}

{{--                $("input[name='renovado']").change(function() {--}}
{{--                    if ($(this).val() === '1') {--}}
{{--                        $("input[name='dataRenovacao']").prop("disabled", false);--}}
{{--                    } else {--}}
{{--                        $("input[name='dataRenovacao']").prop("disabled", true);--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}

        <script>
            $(document).ready(function() {
                // Quando um dos botões de rádio "Contrato renovado?" é alterado
                $("input[name='renovado']").change(function() {
                    if ($(this).val() === '1') {
                        // Habilita o campo de "Data Renovação"
                        $("input[name='dataRenovacao']").prop("disabled", false);
                        //$(".date-picker").datepicker("destroy"); // Desativa todos os outros date-pickers
                    } else {
                        // Desabilita o campo de "Data Renovação"
                        $("input[name='dataRenovacao']").prop("disabled", true);
                        // Reativa os outros date-pickers
                        // $(".date-picker").datepicker({
                        //     dateFormat: 'yy-mm-dd',
                        //     changeMonth: true,
                        //     changeYear: true,
                        //     onSelect: function (dateText, inst) {
                        //         $(this).val(dateText);
                        //     }
                        // });
                    }
                });
            });
        </script>

        <script>
            $(document).ready(function($) {
                // Selecione o campo 'valorOrdemServico' e aplique a máscara de moeda brasileira
                $('#valorContrato').maskMoney({
                    prefix: 'R$ ',
                    thousands: '.',
                    decimal: ',',
                    allowZero: false,
                    showSymbol: true
                });

                // Adicione um evento de envio do formulário
                $('#editContrato').submit(function(event) {
                    // Obtém o valor formatado do campo
                    var valorFormatado = $('#valorContrato').val();

                    // Remove o prefixo 'R$ ' e substitui vírgulas por pontos
                    valorFormatado = valorFormatado.replace('R$ ', '').replace('', '');

                    // Define o valor formatado no campo
                    $('#valorContrato').val(valorFormatado);

                    // Continua com o envio do formulário
                    return true;
                });
            });
        </script>

    </div>
@endsection


