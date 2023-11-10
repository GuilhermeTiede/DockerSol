@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vizualizar Contrato')
@section('actualPage', 'Vizualizar -> Contratos')
@section('button', 'Voltar')
@section('link', route('contratos.index'))

@section('content')
    <h3>Contrato:{{$contrato->nomeContrato}}</h3>

    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form method="POST" action="{{route('upload.documento')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="formFile"  class="col-sm-12 col-md-2 col-form-label">Anexar Documento</label>
            <div class="col-sm-12 col-md-10">
                <label><input type="hidden" name="contrato_id" value="{{$contrato->id }}">
                <input class="form-control-file" type="file" name="documento">
                </label>
                <button type="submit" class="btn btn-primary">Anexar</button>
            </div>
        </div>
    </form>

    <form id="deleteContrato" action="{{route('contratos.destroy',['contrato'=>$contrato->id])}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Cliente</label>
            <div class="col-sm-12 col-md-10">
                <select class="form-control" name="cliente_id" disabled>
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
                    <input class="form-control" type="text" name="nomeContrato" placeholder="Nome do Contrato" value="{{$contrato->nomeContrato}}" disabled>
                </label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Numero</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="numeroContrato" placeholder="Numero do Contrato" value="{{$contrato->numeroContrato}}" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Data Início:</label>
            <div class="col-sm-12 col-md-10">
                <input
                    type="text"
                    class="form-control date-picker"
                    name="dataInicio"
                    placeholder="{{$contrato->dataInicio}}"
                    value="{{$contrato->dataInicio}}"
                    disabled
                />
            </div>
        </div>


        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Data Fim</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control date-picker" type="text" name="dataFim" placeholder="{{$contrato->dataFim}}" value="{{$contrato->dataFim}}" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Valor do Contrato</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control inputmoney" type="text" name="valorContrato" value="{{$contrato->valorContrato}}" placeholder="Preço do Contrato em R$" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Seguro Garantia</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="seguroGarantia" value="{{$contrato->seguroGarantia}}" placeholder="Tem seguro Garantia?" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Responsabilidade Tecnica</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="responsabilidadeTecnica" value="{{$contrato->responsabilidadeTecnica}}" placeholder="ART foram concluidas?" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Observacao</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="observacao" value="{{$contrato->observacao}}" placeholder="ART foram concluidas?" disabled>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Contrato renovado?</label>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="renovado" id="renovadoSim" value="1" {{ $contrato->renovado == 1 ? 'checked' : '' }} disabled>
                <label class="form-check-label" for="renovadoSim">
                    Sim
                </label>
            </div>
            <div class="form-check-inline">
                <input class="form-check-input" type="radio" name="renovado" id="renovadoNao" value="0" {{ $contrato->renovado == 0 ? 'checked' : '' }} disabled>
                <label class="form-check-label" for="renovadoNao">
                    Não
                </label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Data Renovação</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control date-picker" type="text" name="dataRenovacao" value="{{$contrato->dataRenovacao}}" disabled>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-12 col-md-2"></div>
            <div class="col-sm-12 col-md-10">
                <button type="submit" class="btn btn-danger">Deletar Contrato</button>
            </div>
        </div>
    </form>


    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nome do Documento</th>
            <th>Data do Documento</th>
            <th>Tipo do Documento</th>
            <th>Ações</th> <!-- Coluna para as ações -->
        </tr>
        </thead>
        <tbody>
        @foreach ($contrato->documentoscontrato as $documento)
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
