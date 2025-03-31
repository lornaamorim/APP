# Sistema de Gerenciamento de Biblioteca

Este é um sistema simples de gerenciamento de biblioteca desenvolvido com PHP. O sistema permite o cadastro, visualização, edição e exclusão de alunos, autores, livros, categorias e empréstimos.

## Estrutura do Projeto

### Diretórios e Arquivos

- **config.php**: Contém a configuração do ambiente, como as variáveis de conexão ao banco de dados.
- **autoload.php**: Define a função de autoload para carregar automaticamente as classes conforme necessário.
- **routes.php**: Gerencia as rotas da aplicação, definindo como as URLs são mapeadas para os controladores.
- **App/Controller**: Contém os controladores responsáveis pela lógica de negócios de diferentes recursos (Aluno, Autor, Categoria, Livro, Emprestimo, etc.).
- **App/Model**: Contém as classes de modelo que representam as entidades e suas interações com o banco de dados.
- **App/DAO**: Contém as classes responsáveis pela interação direta com o banco de dados.
- **App/View**: Contém os arquivos de visualização que definem a interface do usuário.

---

## Funcionalidades

### Autenticação

- **Login**: Permite que o usuário se autentique no sistema.
- **Logout**: Desloga o usuário da aplicação.

### Gestão de Alunos

- **Cadastro de Alunos**: Permite adicionar novos alunos ao sistema.
- **Edição de Alunos**: Permite a atualização das informações de um aluno existente.
- **Exclusão de Alunos**: Permite excluir um aluno do sistema.
- **Visualização de Alunos**: Exibe todos os alunos cadastrados.

### Gestão de Autores

- **Cadastro de Autores**: Permite adicionar novos autores.
- **Exclusão de Autores**: Permite excluir um autor do sistema.
- **Visualização de Autores**: Exibe todos os autores cadastrados.

### Gestão de Categorias

- **Cadastro de Categorias**: Permite adicionar novas categorias de livros.
- **Exclusão de Categorias**: Permite excluir uma categoria.
- **Visualização de Categorias**: Exibe todas as categorias cadastradas.

### Gestão de Livros

- **Cadastro de Livros**: Permite adicionar novos livros ao sistema.
- **Exclusão de Livros**: Permite excluir livros do sistema.
- **Visualização de Livros**: Exibe todos os livros cadastrados.

### Gestão de Empréstimos

- **Cadastro de Empréstimos**: Permite registrar novos empréstimos de livros.
- **Exclusão de Empréstimos**: Permite excluir um empréstimo de livro.
- **Visualização de Empréstimos**: Exibe todos os empréstimos registrados.

---

## Requisitos

- PHP 7.0 ou superior
- Banco de dados MySQL
- Servidor web (Apache ou Nginx recomendado)

---

## Configuração

### Passo 1: Configurar o Banco de Dados

1. Crie o banco de dados `biblioteca` no MySQL.
2. Crie as tabelas necessárias para armazenar informações sobre alunos, autores, livros, categorias e empréstimos.

Aqui está um exemplo de estrutura das tabelas:

```sql
CREATE TABLE aluno (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  ra VARCHAR(50) NOT NULL,
  curso VARCHAR(100) NOT NULL
);

CREATE TABLE autor (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL
);

CREATE TABLE categoria (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL
);

CREATE TABLE livro (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255) NOT NULL,
  autor_id INT NOT NULL,
  categoria_id INT NOT NULL,
  FOREIGN KEY (autor_id) REFERENCES autor(id),
  FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);

CREATE TABLE emprestimo (
  id INT AUTO_INCREMENT PRIMARY KEY,
  aluno_id INT NOT NULL,
  livro_id INT NOT NULL,
  data_emprestimo DATE NOT NULL,
  data_devolucao DATE,
  FOREIGN KEY (aluno_id) REFERENCES aluno(id),
  FOREIGN KEY (livro_id) REFERENCES livro(id)
);
```

### Passo 2: Configurar as Variáveis de Ambiente

No arquivo `config.php`, ajuste as variáveis de conexão com o banco de dados conforme as informações do seu ambiente:

```php
$_ENV['db']['host'] = "localhost:3307";  // Host do banco de dados
$_ENV['db']['user'] = "root";             // Usuário do banco de dados
$_ENV['db']['pass'] = "etecjau";          // Senha do banco de dados
$_ENV['db']['database'] = "biblioteca";   // Nome do banco de dados
```

### Passo 3: Configurar o Autoload

No arquivo `autoload.php`, o autoload está configurado para carregar automaticamente as classes sempre que necessário. Isso permite que você não precise incluir manualmente cada arquivo de classe.

---

## Como Rodar a Aplicação

1. **Instale o servidor Apache ou Nginx**: Use um servidor local como o XAMPP ou WAMP, ou configure um servidor web de sua preferência.
2. **Coloque o código na pasta do servidor**: Coloque os arquivos do projeto na pasta de documentos do seu servidor (por exemplo, `htdocs` para XAMPP).
3. **Acesse a aplicação pelo navegador**: Abra o navegador e acesse o endereço `http://localhost/[nome-do-projeto]/`.

---

## Estrutura de Controle e Roteamento

O arquivo `routes.php` gerencia o roteamento das requisições HTTP para os controladores apropriados. O código faz uso de um **switch** para mapear as URLs para ações específicas nos controladores. O exemplo a seguir mostra como a rota `/aluno` é mapeada para o controlador `AlunoController`:

```php
switch ($url)
{
    case '/':
        InicialController::index();  // Exibe a página inicial
        break;

    case '/login':
        LoginController::index();  // Exibe a página de login
        break;

    case '/aluno':
        AlunoController::index();  // Lista os alunos cadastrados
        break;

    // Outras rotas...
}
```

---

## Contribuindo

Se você deseja contribuir para este projeto, siga os seguintes passos:

1. Faça um fork deste repositório.
2. Crie uma branch para a sua feature (`git checkout -b feature/nomedafeature`).
3. Faça suas alterações e commite-as (`git commit -am 'Adiciona nova feature'`).
4. Envie para o repositório remoto (`git push origin feature/nomedafeature`).
5. Abra um pull request.

---

## Licença

Este projeto está licenciado sob a **MIT License** - veja o arquivo [LICENSE](LICENSE) para mais detalhes.

---

## Considerações Finais

Este é um sistema simples para fins educacionais e pode ser expandido para incluir mais funcionalidades, como filtros de busca, validação de dados, autenticação e autorização mais robustas, entre outros.

