<?php
namespace Models;

use Config\Database;
use MongoDB\BSON\ObjectId;

class Curso {
    private $collection;

    public function __construct() {
        $database = Database::getConnection();
        $this->collection = $database->cursos;
    }

    public function criar($dados) {
        $resultado = $this->collection->insertOne([
            'nome' => $dados['nome'],
            'codigo' => $dados['codigo'],
            'carga_horaria' => $dados['carga_horaria'],
            'nivel' => $dados['nivel'],
            'preco' => $dados['preco'],
            'estudantes_matriculados' => [] // Referências de estudantes
        ]);
        
        return $resultado->getInsertedId();
    }

    public function matricularEstudante($cursoId, $estudanteId) {
        $this->collection->updateOne(
            ['_id' => new ObjectId($cursoId)],
            ['$addToSet' => ['estudantes_matriculados' => new ObjectId($estudanteId)]]
        );
    }

    public function obterPorId($id) {
        return $this->collection->findOne(['_id' => new ObjectId($id)]);
    }

    public function listarTodos() {
        return $this->collection->find();
    }
}