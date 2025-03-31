<?php

namespace App\Model;

use App\DAO\AlunoDao;  // Importa a classe AlunoDAO para interagir com o banco de dados
use Exception;  // Importa a classe Exception para o tratamento de erros

// Define a classe Aluno, que representa um aluno no sistema e herda de Model
final class Aluno extends Model
{
    // Propriedade para armazenar o ID do aluno (nullable)
    public ?int $id = null;

    /**
     * Atributo Nome
     *
     * Representa o nome do aluno. O nome deve ter pelo menos 3 caracteres.
     * Caso contrário, uma exceção é lançada.
     */
    public ?string $Nome
    {
        set
        {
            // Verifica se o nome possui pelo menos 3 caracteres
            if (strlen($value) < 3)
                throw new Exception("Nome deve ter no mínimo 3 caracteres.");

            $this->Nome = $value;  // Define o valor do nome
        }

        // Retorna o valor do nome, ou null caso o nome não tenha sido definido
        get => $this->Nome ?? null;
    }

    /**
     * Atributo RA
     *
     * Representa o RA do aluno. O RA não pode ser vazio, e uma exceção é lançada caso contrário.
     */
    public ?string $RA
    {
        set
        {
            // Verifica se o RA não está vazio
            if (empty($value))
                throw new Exception("Preencha o RA");

            $this->RA = $value;  // Define o valor do RA
        }

        // Retorna o valor do RA, ou null caso o RA não tenha sido definido
        get => $this->RA ?? null;
    }

    /**
     * Atributo Curso
     *
     * Representa o curso do aluno. O curso deve ter pelo menos 3 caracteres.
     * Caso contrário, uma exceção é lançada.
     */
    public ?string $Curso
    {
        set
        {
            // Verifica se o curso possui pelo menos 3 caracteres
            if (strlen($value) < 3)
                throw new Exception("Curso deve ter mínimo 3 caracteres.");

            $this->Curso = $value;  // Define o valor do curso
        }

        // Retorna o valor do curso, ou null caso o curso não tenha sido definido
        get => $this->Curso ?? null;
    }

    /**
     * Método save
     *
     * Este método salva o modelo de aluno no banco de dados. 
     * Ele chama o método `save` da classe `AlunoDAO` para realizar a operação de inserção ou atualização.
     *
     * @return Aluno Retorna o objeto Aluno após a operação de salvar.
     */
    function save(): Aluno
    {
        return new AlunoDAO()->save($this);  // Chama o método de salvar do AlunoDAO
    }

    /**
     * Método getById
     *
     * Este método busca um aluno pelo ID no banco de dados.
     * Ele utiliza o método `selectById` da classe `AlunoDAO` para realizar a consulta.
     *
     * @param int $id O ID do aluno a ser buscado.
     * @return Aluno|null Retorna o modelo Aluno com os dados do aluno ou null se não encontrado.
     */
    function getById(int $id): ?Aluno
    {
        return new AlunoDAO()->selectById($id);  // Chama o método de busca por ID no AlunoDAO
    }

    /**
     * Método getAllRows
     *
     * Este método busca todos os alunos no banco de dados.
     * Ele utiliza o método `select` da classe `AlunoDAO` para realizar a consulta.
     *
     * @return array Retorna um array de objetos Aluno, representando todos os alunos no banco de dados.
     */
    function getAllRows(): array
    {
        $this->rows = new AlunoDAO()->select();  // Chama o método de seleção de todos os alunos no AlunoDAO
        return $this->rows;  // Retorna os dados dos alunos
    }

    /**
     * Método delete
     *
     * Este método exclui um aluno do banco de dados com base no ID fornecido.
     * Ele utiliza o método `delete` da classe `AlunoDAO` para realizar a operação de exclusão.
     *
     * @param int $id O ID do aluno a ser excluído.
     * @return bool Retorna true se a exclusão foi bem-sucedida, ou false caso contrário.
     */
    function delete(int $id): bool
    {
        return new AlunoDAO()->delete($id);  // Chama o método de exclusão do AlunoDAO
    }
}

