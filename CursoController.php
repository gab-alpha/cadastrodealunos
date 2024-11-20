<?php
namespace Controllers;

use Models\Curso;

class CursoController {
    private $modelCurso;

    public function __construct() {
        $this->modelCurso = new Curso();
    }

    public function criar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cursoId = $this->modelCurso->criar($_POST);
            header('Location: listar.php');
        }
    }

    public function listar() {
        return $this->modelCurso->listarTodos();
    }
}