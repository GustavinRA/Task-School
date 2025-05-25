<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task School</title>
</head>
<body>

    <a href="{{ route('user.index')}}">Listar</a><br>
    <a href="{{ route('user.edit', ['user' => $user->id])}}">Editar</a><br>
    
    <h2>Visualizar Usuários</h2>

    @if(session('success'))
        <p style="color: #086;">
            {{ session('success') }}
        </p>
    @endif

    ID {{ $user->id }}<br>
    Nome: {{ $user->name }}<br>
    E-mail {{ $user->email }}<br>
    Cadastrado: {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}<br>
    Editado: {{ \Carbon\Carbon::parse($user->update_at)->format('d/m/Y H:i:s') }}<br>

</body>
</html>