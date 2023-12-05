@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vizualizar Os')
@section('actualPage', 'Vizualizar -> Ordens Servicos')
@section('button', 'Voltar')
@section('link', route('ordensservicos.index'))

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
        <form method="POST" action="{{route('upload.documento')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <label for="formFile"  class="col-sm-12 col-md-2 col-form-label">Anexar Documento</label>
                <div class="col-sm-12 col-md-10">
                    <label><input type="hidden" name="contrato_id" value="{{$ordemServico->contrato->id }}">
                        <input class="form-control-file" type="file" name="documento">
                    </label>
                    <button type="submit" class="btn btn-primary">Anexar</button>
                </div>
            </div>
        </form>

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
        @foreach ($ordemServico->contrato->documentoscontrato as $documento)
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


@endsection
