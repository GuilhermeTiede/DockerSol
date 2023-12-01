@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@section('actualPage', 'Home')
@section('button', 'Período')
@section('link', route('notasfiscais.index'))
@section('content')
    <div style="text-align: center;">
        <img src="{{asset('back/vendors/images/image.gif')}}" alt="Em Construção" width="300">
        <p>Nossa Home Page está em construção, utilize o Menu Lateral para navegar no restante do site :)</p>
    </div>

@endsection

