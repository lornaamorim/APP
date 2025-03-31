<?php

// Importação de múltiplos controladores para facilitar o gerenciamento de rotas
use App\Controller\{
    AlunoController,         // Controlador responsável pelas operações dos alunos
    InicialController,       // Controlador para a página inicial
    LoginController,         // Controlador para autenticação de usuários (login/logout)
    AutorController,         // Controlador para operações sobre autores
    CategoriaController,     // Controlador para categorias de livros
    LivroController,         // Controlador para operações com livros
    EmprestimoController     // Controlador para controle de empréstimos de livros
};

// Obtém a URL da requisição atual e extrai o caminho (sem parâmetros)
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Processamento das rotas com base na URL da requisição
switch ($url)
{
    // Rota para a página inicial
    case '/':
        InicialController::index(); // Chama o método index do InicialController
        break;

    /* Rotas para login */
    case '/login':
        LoginController::index();  // Chama o método index do LoginController (exibe o formulário de login)
        break;

    case '/logout':
        LoginController::logout(); // Chama o método logout do LoginController (desloga o usuário)
        break;

    /* Rotas para alunos */
    case '/aluno':
        AlunoController::index();  // Chama o método index do AlunoController (lista os alunos)
        break;

    case '/cadastro':
        AlunoController::cadastro(); // Chama o método cadastro do AlunoController (exibe o formulário de cadastro)
        break;

    case '/aluno/cadastro':
        AlunoController::cadastro(); // Chama o método cadastro do AlunoController para um aluno específico
        break;

    case '/aluno/delete':
        AlunoController::delete(); // Chama o método delete do AlunoController (exclui um aluno)
        break;

    /* Rotas para autores */
    case '/autor':
        AutorController::index(); // Chama o método index do AutorController (lista os autores)
        break;

    case '/autor/cadastro':
        AutorController::cadastro(); // Chama o método cadastro do AutorController (exibe o formulário de cadastro de autor)
        break;

    case '/autor/delete':
        AutorController::delete(); // Chama o método delete do AutorController (exclui um autor)
        break;

    /* Rotas para categorias */
    case '/categoria':
        CategoriaController::index(); // Chama o método index do CategoriaController (lista as categorias)
        break;

    case '/categoria/cadastro':
        CategoriaController::cadastro(); // Chama o método cadastro do CategoriaController (exibe o formulário de cadastro de categoria)
        break;

    case '/categoria/delete':
        CategoriaController::delete(); // Chama o método delete do CategoriaController (exclui uma categoria)
        break;

    /* Rotas para livros */
    case '/livro':
        LivroController::index(); // Chama o método index do LivroController (lista os livros)
        break;

    case '/livro/cadastro':
        LivroController::cadastro(); // Chama o método cadastro do LivroController (exibe o formulário de cadastro de livro)
        break;

    case '/livro/delete':
        LivroController::delete(); // Chama o método delete do LivroController (exclui um livro)
        break;

    /* Rotas para empréstimos */
    case '/emprestimo':
        EmprestimoController::index(); // Chama o método index do EmprestimoController (lista os empréstimos)
        break;

    case '/emprestimo/cadastro':
        EmprestimoController::cadastro(); // Chama o método cadastro do EmprestimoController (exibe o formulário de cadastro de empréstimo)
        break;

    case '/emprestimo/delete':
        EmprestimoController::delete(); // Chama o método delete do EmprestimoController (exclui um empréstimo)
        break;
}
