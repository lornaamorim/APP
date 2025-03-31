<?php

// Define a constante BASE_DIR, que aponta para o diretório base do projeto
define('BASE_DIR', dirname(__FILE__, 2));

// Define a constante VIEWS, que aponta para o diretório onde as views estão localizadas
define('VIEWS', BASE_DIR . '/App/View');

// Configura as variáveis de ambiente para a conexão com o banco de dados

$_ENV['db']['host'] = "localhost:3307"; // Endereço do servidor de banco de dados (com a porta)
$_ENV['db']['user'] = "root";           // Usuário para conectar ao banco de dados
$_ENV['db']['pass'] = "etecjau";        // Senha para o usuário
$_ENV['db']['database'] = "biblioteca"; // Nome do banco de dados


