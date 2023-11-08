@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Vizualizar Cliente')
@section('actualPage', 'Vizualizar –> Clientes')
@section('button', 'Voltar')
@section('link', route('clientes.index'))
@section('content')
    <h3>Cliente: {{$cliente->nome}}</h3>

    <form id="deleteEmpresa" action="{{route('clientes.destroy',['cliente'=>$cliente->id])}}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Clientes</label>
            <div class="col-sm-12 col-md-10">
                <select class="form-control" name="empresa_id" disabled>
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
                <input class="form-control" type="text" name="nome" placeholder="Nome da Empresa" value="{{$cliente->nome}}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">CNPJ</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="cnpj" placeholder="CNPJ da Empresa" value = "{{$cliente->cnpj}}"disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Estado</label>
            <div class="col-sm-12 col-md-10">
                <select class="form-control" name="estado" value="{{$cliente->estado}}"disabled>
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
                <input class="form-control" type="text" name="municipio" placeholder="Município" value = "{{$cliente->municipio}}"disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Logradouro</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="logradouro" placeholder="Logradouro" value = "{{$cliente->logradouro}}"disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Número</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="numero" placeholder="Número" value = "{{$cliente->numero}}"disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">CEP</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" type="text" name="cep" placeholder="CEP" value = "{{$cliente->cep}}"disabled>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12 col-md-2"></div>
            <div class="col-sm-12 col-md-10">
                <button type="submit" class="btn btn-danger">Deletar Cliente</button>
            </div>
        </div>
    </form>
@endsection
