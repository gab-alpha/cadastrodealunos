<?php
namespace Controllers;

use Models\Estudante;
use Models\Curso;

class EstudanteController {
    private $modelEstudante;
    private $modelCurso;

    public function __construct() {
        $this->modelEstudante = new Estudante();
        $this->modelCurso = new Curso();
    }

    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $estudanteId = $this->modelEstudante->criar($_POST);
            
            // Matrícula em cursos (se selecionados)
            if (isset($_POST['cursos'])) {
                foreach ($_POST['cursos'] as $cursoId) {
                    $this->modelEstudante->matricularCurso($estudanteId, $cursoId);
                    $this->modelCurso->matricularEstudante($cursoId, $estudanteId);
                }
            }

            header('Location: listar.php');
        }
    }

    public function listar() {
        return $this->modelEstudante->listarTodos();
    }
}