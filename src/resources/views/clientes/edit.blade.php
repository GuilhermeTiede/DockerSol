@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Editar Cliente')
@section('actualPage', 'Editar -> Cliente')
@section('button', 'Voltar')
@section('link', route('clientes.index'))
@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h4 class="text-blue h4">Editar Cliente</h4>
                <p class="mb-30">Edite os campos:</p>
            </div>
        </div>

        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif



        <form id="editEmpresa" action="{{route('clientes.update',['cliente'=>$cliente->id])}}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Empresa</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="empresa_id">
                        <option value="{{$cliente->empresa->id}}" >{{$cliente->empresa->nome}}</option>
                        @foreach($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->nome }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Nome</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="nome" placeholder="Nome da Empresa" value="{{$cliente->nome}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">CNPJ</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="cnpj" placeholder="CNPJ da Empresa" value = "{{$cliente->cnpj}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Estado</label>
                <div class="col-sm-12 col-md-10">
                    <select class="form-control" name="estado" value="{{$cliente->estado}}">
                        <option value="" disabled selected>{{$cliente->estado}}</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Município</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="municipio" placeholder="Município" value = "{{$cliente->municipio}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Logradouro</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="logradouro" placeholder="Logradouro" value = "{{$cliente->logradouro}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Número</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="numero" placeholder="Número" value = "{{$cliente->numero}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">CEP</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control" type="text" name="cep" placeholder="CEP" value = "{{$cliente->cep}}">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 col-md-2"></div>
                <div class="col-sm-12 col-md-10">
                    <button type="submit" class="btn btn-primary">Editar Cliente</button>
                </div>
            </div>
        </form>
    </div>
@endsection
