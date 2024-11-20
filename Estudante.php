<?php
namespace Models;

use Config\Database;
use MongoDB\BSON\ObjectId;

class Estudante {
    private $collection;

    public function __construct() {
        $database = Database::getConnection();
        $this->collection = $database->estudantes;
    }

    public function criar($dados) {
        $resultado = $this->collection->insertOne([
            'nome' => $dados['nome'],
            'rg' => $dados['rg'],
            'cpf' => $dados['cpf'],
            'data_nascimento' => $dados['data_nascimento'],
            'telefone1' => $dados['telefone1'],
            'telefone2' => $dados['telefone2'],
            'nome_mae' => $dados['nome_mae'],
            'nome_pai' => $dados['nome_pai'],
            'endereco' => [
                'logradouro' => $dados['logradouro'],
                'numero' => $dados['numero'],
                'bairro' => $dados['bairro'],
                'cidade' => $dados['cidade'],
                'estado' => $dados['estado']
            ],
            'cursos_matriculados' => [] // Referências de cursos
        ]);
        
        return $resultado->getInsertedId();
    }

    public function matricularCurso($estudanteId, $cursoId) {
        $this->collection->updateOne(
            ['_id' => new ObjectId($estudanteId)],
            ['$addToSet' => ['cursos_matriculados' => new ObjectId($cursoId)]]
        );
    }

    public function obterPorId($id) {
        return $this->collection->findOne(['_id' => new ObjectId($id)]);
    }

    public function listarTodos() {
        return $this->collection->find();
    }
}