@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Relatorio Contas a Pagar')
@section('actualPage', 'Relatório')
@section('button', 'Voltar')
@section('link', route('contasapagar.index'))
<!-- resources/views/contasapagar/exibirrelatorio.blade.php -->



@section('content')


@endsection

