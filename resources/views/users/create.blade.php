<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="{{route('user.index')}}">Listar usuário</a><br>
    <h2>Cadastrar usuário</h2>

    @if($errors->any())
        
        @foreach($errors->all() as $error)
        <p style="color: red;">    
             {{ $error }}
        </p>
        @endforeach
    @endif


    <form action="{{ route('user-store') }}" method="POST">
        @csrf
        @method('POST')

        <label>Nome:</label>
        <input type="text" name="name" placeholder="Nome completo"
        value="{{ old ('name') }}"><br><br>

        <label>E-mail:</label>
        <input type="email" name="email" placeholder="E-mail do usuário"
        value="{{ old ('email') }}"><br><br>

        <label>Senha:</label>
        <input type="password" name="password" placeholder="Senha com no mínimo 10 caracteres"><br><br>

        <button type="submit">Cadastrar</button>
    </form>
    
</body>
</html>