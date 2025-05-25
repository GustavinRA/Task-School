@extends('layouts.auth')

@section('content')

<main class="form-signin w-100 m-auto text-center bg-light rounded">


    <form action="{{ route('login.process') }}" method="POST">
        @csrf
        @method('POST')

        <h1 class="h3 mb-3 fw-normal">Task Scholl</h1>
        <x-alert />
        <div class="form-floating mb-4">
            <input type="email" name="email" class="form-control" id="email" placeholder="email" value="{{ old('email') }}">
            <label for="email">Insira e-mail de usuário</label>
        </div>

        <div class="mb-4">
            <div class="input-group">
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                    <label for="password">Digite sua senha</label>
                </div>
                <span class="input-group-text" role="button" onclick="togglePassword('password', this)"><i class="bi bi-eye"></i></span>
            </div>
        </div>

        <button class="btn btn-primary w-100 py-2 mb-4" type="submit">Acessar</button>


    </form>
</main>

@endsection