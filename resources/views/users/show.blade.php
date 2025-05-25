@extends('layouts.admin')

@section('content')

<div class="card mt-4 mb-4 border-light shadow">


    <div class="card-header hstack gap-2">
        <span>Visualizar Usuários</span>
        <span class="ms-auto d-sm-flex flex-row">


            <a href="{{ route('user.index')}}" class="btn btn-info btn-sm me-1">Listar</a><br>
            <a href="{{ route('user.edit', ['user' => $user->id])}}" class="btn btn-warning btn-sm me-1">Editar</a><br>
        </span>
    </div>

    <div class="card-body">

        <x-alert />

        <dl class="row">
            <dt class="col-sm-3">ID:</dt>
            <dd class="col-sm-9"> {{ $user->id }}</dd>

            <dt class="col-sm-3">Nome:</dt>
            <dd class="col-sm-9"> {{ $user->name }}</dd>

            <dt class="col-sm-3">Email:</dt>
            <dd class="col-sm-9"> {{ $user->email }}</dd>

            <dt class="col-sm-3">Cadastrado:</dt>
            <dd class="col-sm-9"> {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }} </dd>

            <dt class="col-sm-3">Editado:</dt>
            <dd class="col-sm-9"> {{ \Carbon\Carbon::parse($user->update_at)->format('d/m/Y H:i:s') }}</dd>
        </dl>

    </div>
</div>
@endsection