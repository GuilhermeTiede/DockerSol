@extends('layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login Page')
@section('content')

    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-primary">Login Soluminar</h2>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="login-menu">
            @csrf

            @error('email')
            <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
            <div class="input-group custom">
                <input id="email" name="email" type="text" class="form-control form-control-lg" placeholder="E-mail" >
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                </div>
            </div>
            @error('password')
            <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
            <div class="input-group custom">
                <input id="password" name="password" type="password" class="form-control form-control-lg" placeholder="Senha" >
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
            </div>
            <div class="row pb-30">
                <div class="col-6">
                    <div class="custom-control custom-checkbox">
                        <input id="remember_me" name="remember" type="checkbox" class="custom-control-input">
                        <label class="custom-control-label" for="remember_me">Lembrar a senha</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="forgot-password">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                                {{ __('Esqueceu sua senha?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group mb-0">
                        <!--
                        use code for form submit
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                    -->
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="{{ __('Entrar') }}">
                    </div>
                    <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373" style="color: rgb(112, 115, 115);">
                        OU
                    </div>
                    <div class="input-group mb-0">
                        <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('register') }}">{{ __('Junte-se a nós') }}</a>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
