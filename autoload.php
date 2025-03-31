<?php

// Registra a função anônima para autoload de classes
spl_autoload_register(function ($nome_da_classe)
{
    // Constrói o caminho do arquivo com base no nome da classe
    $arquivo = BASE_DIR . "/" . $nome_da_classe . ".php";

    // Verifica se o arquivo existe no caminho especificado
    if(file_exists($arquivo))
    {
        // Inclui o arquivo se ele existir
        include $arquivo;
    }
    else
        // Lança uma exceção caso o arquivo não seja encontrado
        throw new Exception("Arquivo não encontrado");
});
