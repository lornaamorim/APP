<?php

namespace App\Model;

use App\DAO\AutorDAO;  
use Exception; 

final class Autor extends Model
{
    public ?int $id = null;

    public ?string $Nome
    {
        set
        {
            if (strlen($value) < 3)
                throw new Exception("Nome deve ter no mínimo 3 caracteres.");

            $this->Nome = $value;
        }

        get => $this->Nome ?? null;
    }

    public ?string $Data_nasc
    {
        set
        {
            if (empty($value))
                throw new Exception("Preencha a Data de Nascimento:");

            $this->Data_nasc = $value;
        }

        get => $this->Data_nasc ?? null;
    }

    public ?string $Cpf
    {
        set
        {
            if (strlen($value) < 3)
                throw new Exception("O CPF deve ter mínimo 3 caracteres.");

            $this->Cpf = $value;
        }

        get => $this->Cpf ?? null;
    }

    function save(): Autor
    {
        return new AutorDAO()->save($this); 
    }

    function getById(int $id): ?Autor
    {
        return new AutorDAO()->selectById($id);
    }

    function getAllRows(): array
    {
        $this->rows = new AutorDAO()->select(); 
        return $this->rows;

    function delete(int $id): bool
    {
        return new AutorDAO()->delete($id);
    }
}
}