<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Lista de Tarefas</title>
</head>
<body>
    <div class="container">
        <h1>Lista de Tarefas</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-3">
            <a href="{{ route('tarefas.create') }}" class="btn btn-primary">Adicionar Tarefa</a>
            <a href="{{ url('/') }}" class="btn btn-secondary">Voltar</a>
        </div>

        <form action="{{ route('tarefas.importar') }}" method="POST" enctype="multipart/form-data" class="mb-3">
            @csrf
            <div class="form-group">
                <label for="arquivo">Upload de Tarefas (csv, txt)</label>
                <input type="file" class="form-control" id="arquivo" name="arquivo" required>
            </div>
            <button type="submit" class="btn btn-success">Importar Tarefas</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tarefas as $tarefa)
                    <tr id="tarefa-{{ $tarefa->id }}">
                        <td>{{ $tarefa->id }}</td>
                        <td>{{ $tarefa->titulo }}</td>
                        <td>{{ $tarefa->descricao }}</td>
                        <td>
                            <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn btn-warning">Editar</a>
                            <button class="btn btn-danger delete-btn" data-id="{{ $tarefa->id }}">Deletar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const id = button.getAttribute('data-id');
                    const actionUrl = `/tarefas/${id}`;

                    if (confirm('Tem certeza que deseja deletar esta tarefa?')) {
                        axios.delete(actionUrl)
                            .then(response => {
                                if (response.data.success) {
                                    document.getElementById(`tarefa-${id}`).remove();
                                    alert(response.data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Erro ao deletar a tarefa:', error);
                            });
                    }
                });
            });
        });
    </script>
</body>
</html>
