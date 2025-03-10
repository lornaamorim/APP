<?php

use App\Controller\{
    AlunoController,
    InicialController,
    LoginController,
    AutorController,
    CategoriaController,
    LivroController,
    EmprestimoController
};

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($url)
{
    case'/';
        InicialController::index();
    break;

    /* Rotas para login */

    case '/login';
        LoginController::index();
    break;

    case '/logout';
        LoginController::logout();
    break;

    /* Rotas para alunos */

    case '/aluno';
        AlunoController::index();
    break;

    case '/cadastro';
        AlunoController::cadastro();
    break;

    case '/aluno/cadastro';
        AlunoController::cadastro();
    break;

    case '/aluno/delete';
        AlunoController::delete();
    break;

    /* Rotas para autores */

    case '/autor';
        AlunoController::index();
    break;

    case '/autor/cadastro';
    AlunoController::cadastro();
    break;

    case '/autor/delete';
    AlunoController::delete();
    break;

    /* Rotas para categorias */

    case '/categoria';
        AlunoController::index();
    break;

    case '/categoria/cadastro';
        AlunoController::cadastro();
    break;

    case '/categoria/delete';
        AlunoController::delete();
    break;

    /* Rotas para livros */

    case '/livro';
        AlunoController::index();
    break;

    case '/livro/cadastro';
        AlunoController::cadastro();
    break;

    case '/livro/delete';
        AlunoController::delete();
    break;

    
    /* Rotas para emprestimos */

    case '/emprestimo';
        AlunoController::index();
    break;

    case '/emprestimo/cadastro';
        AlunoController::cadastro();
    break;

    case '/emprestimo/delete';
        AlunoController::delete();
    break;


}