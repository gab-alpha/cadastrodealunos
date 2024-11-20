<?php
require_once '../../vendor/autoload.php';
use Controllers\EstudanteController;
use Models\Curso;

$cursoModel = new Curso();
$cursos = $cursoModel->listarTodos();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Estudante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Cadastro de Estudante</h2>
        <form method="POST" action="../controllers/estudante_controller.php">
            <div class="mb-3">
                <label>Nome Completo</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            
            <!-- Campos adicionais: RG, CPF, etc. -->
            
            <div class="mb-3">
                <label>Cursos</label>
                <select name="cursos[]" multiple class="form-control">
                    <?php foreach($cursos as $curso): ?>
                        <option value="<?= $curso['_id'] ?>"><?= $curso['nome'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</body>
</html>