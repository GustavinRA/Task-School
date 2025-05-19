<!DOCTYPE html>
<html>
<head>
    <title>Nova Tarefa</title>
</head>
<body>
    <h1>Adicionar Nova Tarefa</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <label for="title">Título:</label><br>
        <input type="text" id="title" name="title" value="{{ old('title') }}"><br><br>

        <label for="description">Descrição:</label><br>
        <textarea id="description" name="description">{{ old('description') }}</textarea><br><br>

        <button type="submit">Salvar</button>
    </form>
</body>
</html>
