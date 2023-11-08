@extends('layouts.register-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Register Page')
@section('content')
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-primary">Registrar</h2>
        </div>

        <form method="POST" action="{{ route('register') }}" class="login-menu" onsubmit="return validarFormulario()">
            @csrf

            @error('name')
            <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
            <div class="input-group custom">
                <input id="name" name="name" type="text" class="form-control form-control-lg" placeholder="Nome" >
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                </div>
            </div>

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

            @error('password')
            <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
            <div class="input-group custom">
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control form-control-lg" placeholder="Confirme sua Senha" >
                <div class="input-group-append custom">
                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group mb-0">
                        <!--
                        use code for form submit
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
                    -->
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="{{ __('Criar Conta') }}">
                    </div>
                </div>
            </div>
        </form>
        <script>
            function validarFormulario() {
                var email = document.getElementById('email').value;
                var password = document.getElementById('password').value;
                var name = document.getElementById('name').value;
                var password_confirmation = document.getElementById('password_confirmation').value;
                // Realize a validação dos campos conforme suas regras
                if (name.trim() === '') {
                    alert('O campo nome é obrigatório.');
                    return false; // Impede o envio do formulário
                }

                if (email.trim() === '') {
                    alert('O campo de e-mail é obrigatório.');
                    return false; // Impede o envio do formulário
                }

                if (password.trim() === '') {
                    alert('O campo de senha é obrigatório.');
                    return false; // Impede o envio do formulário
                }
                if (password_confirmation.trim() === '') {
                    alert('O campo de confirmacao de senha é obrigatório.');
                    return false; // Impede o envio do formulário
                }
                // Se todos os campos estiverem válidos, o formulário será enviado normalmente
                return true;
            }
        </script>
    </div>
@endsection
