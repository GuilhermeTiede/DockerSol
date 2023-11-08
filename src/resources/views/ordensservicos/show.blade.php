@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vizualizar Os')
@section('actualPage', 'Vizualizar -> Ordens Servicos')
@section('button', 'Voltar')
@section('link', route('ordensservicos.index'))

@section('content')

    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Detalhes da Ordem de Serviço</h4>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Contrato</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="contrato_id" value="{{ $ordemServico->contrato->nomeContrato }}" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Valor</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="valorOrdemServico" value="{{ $ordemServico->valorOrdemServico }}" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Data de Ordem de Serviço</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="dataOrdemServico" value="{{ $ordemServico->dataOrdemServico }}" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Número de Ordem de Serviço</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="numeroOrdemServico" value="{{ $ordemServico->numeroOrdemServico }}" disabled>
            </div>
        </div>

        <!-- Outros detalhes da Ordem de Serviço aqui -->

    </div>
@endsection
