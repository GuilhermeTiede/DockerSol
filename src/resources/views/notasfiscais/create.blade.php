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

    <form method="POST" action="{{route('upload.notafiscal')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="formFile"  class="col-sm-12 col-md-2 col-form-label">Inserir XML Nota Fiscal</label>
            <div class="col-sm-12 col-md-10">
                <label><h5>Selecione o arquivo XML da Nota Fiscal:</h5>
                    <input class="form-control-file" type="file" name="documento" accept=".xml" required>
                </label>
                <button type="submit" class="btn btn-primary">Cadastrar Nota</button>
            </div>
        </div>
    </form>


@endsection
