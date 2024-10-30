<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Página Inicial</title>
</head>
<body>
    <div class="container text-center mt-5">
        <h1>Bem-vindo ao Gerenciador de Tarefas</h1>
        <p>Gerencie suas tarefas de forma simples e eficiente.</p>
        <a href="{{ route('tarefas.index') }}" class="btn btn-primary">Ver Tarefas</a>
    </div>
</body>
</html>
