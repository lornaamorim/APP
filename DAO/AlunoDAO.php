<?php 

namespace App\DAO;

use App\Model\Aluno; // Inclui o modelo Aluno para trabalhar com objetos do tipo Aluno

// Define a classe AlunoDAO, que herda de DAO. Essa classe é responsável pela interação com o banco de dados para a entidade Aluno.
final class AlunoDAo extends DAO
{
    /**
     * Construtor da classe AlunoDAO.
     *
     * O construtor chama o construtor da classe pai (DAO), o qual provavelmente estabelece a conexão com o banco de dados.
     */
    public function __construct()
    {
        parent::__construct();  // Chama o construtor da classe base DAO
    }

    /**
     * Método save
     *
     * Este método é responsável por salvar ou atualizar um aluno no banco de dados.
     * Se o aluno já possui um ID (o que indica que o aluno existe no banco de dados), o método chama o método de atualização.
     * Caso contrário, chama o método de inserção para adicionar o novo aluno.
     *
     * @param Aluno $model O modelo Aluno contendo os dados a serem salvos ou atualizados
     * @return Aluno O modelo Aluno com o ID atribuído após a inserção ou atualização
     */
    public function save(Aluno $model) : Aluno
    {
        // Verifica se o aluno já tem um ID. Se não, insere. Se sim, atualiza.
        return ($model->Id == null) ? $this->insert($model) : $this->update($model);
    }

    /**
     * Método insert
     *
     * Este método insere um novo aluno no banco de dados.
     * A inserção é realizada no banco com o uso de uma consulta SQL e os valores do modelo Aluno.
     *
     * @param Aluno $model O modelo Aluno com os dados a serem inseridos
     * @return Aluno O modelo Aluno com o ID atribuído após a inserção
     */
    public function insert(Aluno $model) : Aluno
    {
        // Define a consulta SQL para inserir os dados do aluno
        $sql = "INSERT INTO aluno (nome, ra, curso) VALUES (?,?,?)";

        // Prepara a consulta para execução
        $stmt = parent::$conexao->prepare($sql);

        // Faz a ligação dos parâmetros da consulta com os dados do modelo
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->RA);
        $stmt->bindValue(3, $model->Curso);

        // Executa a consulta de inserção
        $stmt->execute();

        // Atribui ao modelo o ID do aluno recém-inserido
        $model->Id = parent::$conexao->lastInsertId();

        // Retorna o modelo com o ID atribuído
        return $model;
    }

    /**
     * Método update
     *
     * Este método atualiza os dados de um aluno existente no banco de dados.
     * A atualização é realizada com base no ID do aluno, que já deve existir no banco.
     *
     * @param Aluno $model O modelo Aluno com os dados a serem atualizados
     * @return Aluno O modelo Aluno com o ID mantido após a atualização
     */
    public function update(Aluno $model) : Aluno
    {
        // Define a consulta SQL para atualizar os dados do aluno
        $sql = "UPDATE aluno SET nome=?, ra=?, curso=? WHERE id=?";

        // Prepara a consulta para execução
        $stmt = parent::$conexao->prepare($sql);

        // Faz a ligação dos parâmetros da consulta com os dados do modelo
        $stmt->bindValue(1, $model->Nome);
        $stmt->bindValue(2, $model->RA);
        $stmt->bindValue(3, $model->Curso);
        $stmt->bindValue(4, $model->Id);

        // Executa a consulta de atualização
        $stmt->execute();

        // Retorna o modelo Aluno atualizado
        return $model;
    }

    /**
     * Método selectById
     *
     * Este método busca um aluno no banco de dados com base no seu ID.
     * Caso o aluno não seja encontrado, o método retornará `null`.
     *
     * @param int $id O ID do aluno a ser buscado no banco de dados
     * @return Aluno|null O modelo Aluno encontrado ou null caso não haja aluno com o ID especificado
     */
    public function selectById(int $id) : ?Aluno
    {
        // Define a consulta SQL para buscar o aluno pelo ID
        $sql = "SELECT * FROM aluno WHERE id=?";

        // Prepara a consulta para execução
        $stmt = parent::$conexao->prepare($sql);

        // Faz a ligação do parâmetro da consulta com o ID do aluno
        $stmt->bindValue(1, $id);

        // Executa a consulta
        $stmt->execute();

        // Recupera os dados retornados pela consulta
        $result = $stmt->fetch();

        // Se o aluno for encontrado, cria um objeto Aluno e atribui os valores do banco
        if ($result) {
            $model = new Aluno();
            $model->Id = $result['id'];
            $model->Nome = $result['nome'];
            $model->RA = $result['ra'];
            $model->Curso = $result['curso'];

            return $model;
        }

        // Se não encontrar nenhum aluno, retorna null
        return null;
    }

    public function selectById(int $id) : ?Aluno
    {
        $sql = "SELECT * FROM aluno ";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();

        //Retorna um array com as linhas retornadas da consulta. Observe que
        //o array é um array de objetos. Os objetos são do tipo stdClass e
        //foram criados automaticamente pelo método fetchAll do PDO.
        return $stmt->fetchAll(DAO::FECHT_CLASS, "App\Model\Aluno");
    }

    /**
     * Remove um registro da tabela pessoa do banco de dados.
     * Note que o método exige um parâmetro $id do tipo inteiro.
     */
    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM aluno WHERE is=? ";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}



