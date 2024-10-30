<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Editar Tarefa</title>
</head>
<body>
    <div class="container">
        <h1>Editar Tarefa</h1>
        <form action="{{ route('tarefas.update', $tarefa->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="{{ $tarefa->titulo }}" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea class="form-control" name="descricao" id="descricao">{{ $tarefa->descricao }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('tarefas.index') }}" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>
</html>
