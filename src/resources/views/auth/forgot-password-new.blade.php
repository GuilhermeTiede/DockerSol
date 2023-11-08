@extends('layouts.forgot-password-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Esqueceu a Senha?')

@section('content')
    <div class="login-box bg-white box-shadow border-radius-10">
        <div class="login-title">
            <h2 class="text-center text-primary">Esqueceu sua senha?</h2>
        </div>
        <h6 class="mb-20">
            Digite seu e-mail para receber um link de redefinição
        </h6>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            <div class="input-group custom">
                <input
                    id="email"
                    name = "email" :value="old('email')"
                    type="text"
                    class="form-control form-control-lg"
                    placeholder="Email"
                />
                <div class="input-group-append custom">
										<span class="input-group-text"
                                        ><i class="fa fa-envelope-o" aria-hidden="true"></i
                                            ></span>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-5">
                    <div class="input-group mb-0">
                        <!--
                        use code for form submit
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
                    -->
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Enviar">
                    </div>
                </div>
                <div class="col-2">
                    <div
                        class="font-16 weight-600 text-center"
                        data-color="#707373"
                    >
                        OU
                    </div>
                </div>
                <div class="col-5">
                    <div class="input-group mb-0">
                        <a
                            class="btn btn-outline-primary btn-lg btn-block"
                            href="{{route('login')}}"
                        >Login</a
                        >
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
