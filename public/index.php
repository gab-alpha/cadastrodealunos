<?php
require_once '../vendor/autoload.php';

use Controllers\EstudanteController;
use Controllers\CursoController;

// Configura exibição de erros (remover em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3>Estudantes</h3>
                    </div>
                    <div class="card-body">
                        <a href="/views/estudante/criar.php" class="btn btn-success mb-2">Novo Estudante</a>
                        <a href="/views/estudante/listar.php" class="btn btn-info mb-2">Listar Estudantes</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3>Cursos</h3>
                    </div>
                    <div class="card-body">
                        <a href="/views/curso/criar.php" class="btn btn-success mb-2">Novo Curso</a>
                        <a href="/views/curso/listar.php" class="btn btn-info mb-2">Listar Cursos</a>
                    </div>
                </div>
            </div>
        </div>

        <?php 
        // Exemplo de listagem rápida (opcional)
        $estudanteController = new EstudanteController();
        $cursoController = new CursoController();
        ?>

        <div class="row mt-4">
            <div class="col-md-6">
                <h4>Últimos Estudantes Cadastrados</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $estudantes = $estudanteController->listar();
                        foreach ($estudantes as $estudante): 
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($estudante['nome'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($estudante['cpf'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <h4>Cursos Disponíveis</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Carga Horária</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $cursos = $cursoController->listar();
                        foreach ($cursos as $curso): 
                        ?>
                            <tr>
                                <td><?= htmlspecialchars($curso['nome'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($curso['carga_horaria'] ?? 'N/A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>