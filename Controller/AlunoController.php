<?php

namespace App\Controller;

use App\Model\Aluno; // Inclui o modelo Aluno para interagir com os dados dos alunos
use Exception; // Importa a classe Exception para tratamento de erros

// Define a classe final AlunoController, que herda de Controller
final class AlunoController extends Controller
{
    /**
     * Método index
     * 
     * Responsável por listar todos os alunos.
     * Esse método verifica se o usuário está autenticado e então tenta recuperar os dados dos alunos,
     * tratando possíveis erros ao buscar os dados.
     *
     * @return variant_mod
     */
    public static function index() : variant_mod
    {
         // Verifica se o usuário tem permissão para acessar a página
        parent::isProtected();

        // Cria uma instância do modelo Aluno
        $model = new Aluno();

        try {
            // Tenta buscar todos os alunos do banco de dados
            $model->getAllRows();
        } catch(Exception $e)
        {
             // Caso ocorra um erro, define a mensagem de erro
            $model->setError("Ocorreu um erro ao buscar os alunos:");
            $model->setError($e->getMessage());
        }

        // Renderiza a página de listagem de alunos, passando o modelo (dados) para a visualização
        parent::render('Aluno/lista_aluno.php', $model);
    }

     /**
     * Método cadastro
     * 
     * Responsável por exibir o formulário de cadastro ou edição de um aluno.
     * O método pode ser usado tanto para criar um novo aluno quanto para editar um existente.
     * Caso o método seja chamado via POST, ele tenta salvar os dados no banco de dados.
     *
     * @return void
     */

    public static function cadastro() : void
    {
         // Verifica se o usuário tem permissão para acessar a página
        parent::isProtected();

        // Cria uma instância do modelo Aluno
        $model = new Aluno();

        try
        {

            // Verifica se a requisição é do tipo POST (ou seja, o formulário foi enviado)
            if(parent::isPost())
            {
                // Atribui os valores dos campos do formulário ao modelo
                $model->Id = !empty($_POST['id']) ? $_POST['id'] : null;  // O ID pode ser opcional (caso seja um novo cadastro)
                $model->Nome = $_POST['nome']; // Nome do aluno
                $model->RA = $_POST['ra']; // RA do aluno
                $model->Curso = $POST['curso'];  // Curso do aluno
                 // Tenta salvar os dados do aluno no banco de dados
                $model->save(); 

                // Redireciona para a página de listagem de alunos após salvar
                parent::redirect("/aluno");

            } else {

                // Caso o formulário não tenha sido enviado, verifica se existe um ID na URL para editar um aluno
                if(isset($_GET['id']))
                {
                    // Recupera os dados do aluno pelo ID para editar
                    $model = $model->getById( (int) $_GET['id']);
                }
            }
        } catch(Exception $e) {
             // Caso ocorra um erro ao salvar ou buscar os dados, define a mensagem de erro
            $model->setError($e->getMessage());
        }
        
        // Renderiza o formulário de cadastro/edição de aluno, passando o modelo (dados) para a visualização
        parent::render('Aluno/form_aluno.php', $model);
    }
} 
