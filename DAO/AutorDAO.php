<?php 

namespace App\DAO;

use App\Model\Autor;


final class AutorDAO extends DAO
{
    
    public function __construct()
    {
        parent::__construct(); 
    }

    public function save(Autor $model) : Autor
    {
        return ($model->Id == null) ? $this->insert($model) : $this->update($model);
    }

    public function insert(Autor $model) : Autor
    {
        $sql = "INSERT INTO autor (nome, data_nasc, cpf) VALUES (?,?,?)";

        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->Data_nasc);
        $stmt->bindValue(3, $model->Cpf);

        $stmt->execute();

        $model->Id = parent::$conexao->lastInsertId();

        return $model;
    }

    public function update(Autor $model) : Autor
    {
        $sql = "UPDATE autor SET nome=?, data_nasc=?, cpf=? WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->Data_nasc);
        $stmt->bindValue(3, $model->Cpf);
        $stmt->bindValue(4, $model->Id);

        $stmt->execute();

        return $model;
    }

    public function selectById(int $id) : ?Autor
    {
        $sql = "SELECT * FROM autor";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FECHT_CLASS, "App\Model\Autor");
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM autor WHERE is=? ";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}