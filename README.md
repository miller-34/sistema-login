# Sistema de login em PHP

Aplicação didática de autenticação feita com PHP puro, MySQL e Bootstrap. O
sistema apresenta uma tela de login e protege as páginas internas usando uma
sessão PHP.

## O que o sistema faz

- autentica um usuário cadastrado no MySQL;
- compara a senha informada com um hash seguro usando `password_verify`;
- mantém o usuário autenticado por sessão;
- impede o acesso às páginas Home, Page 1, Page 2 e Page 3 sem login;
- permite encerrar a sessão pelo link **Sair**;
- utiliza consultas preparadas com PDO.

As páginas internas contêm textos demonstrativos. O projeto não possui tela de
cadastro, recuperação de senha ou gerenciamento de usuários.

## Requisitos

- Docker;
- Docker Compose.

Não é necessário instalar PHP ou MySQL diretamente na máquina.

## Como executar

Na raiz do projeto, execute:

```bash
docker compose up --build -d
```

Quando os containers estiverem saudáveis, acesse:

<http://localhost:18080>

Credenciais iniciais de demonstração:

- usuário: `admin`
- senha: `abc123`

Para acompanhar os logs:

```bash
docker compose logs -f
```

Para encerrar a aplicação:

```bash
docker compose down
```

Os dados do MySQL ficam preservados no volume Docker `mysql_data`. Para apagar
também o banco e recriar o usuário inicial na próxima execução, use
`docker compose down -v`. Esse comando remove definitivamente os dados locais.

## Configuração

Os valores padrão funcionam para desenvolvimento. Para personalizá-los, copie o
arquivo de exemplo e edite as variáveis antes de iniciar os containers:

```bash
cp .env.example .env
```

Variáveis disponíveis:

| Variável | Finalidade | Padrão |
| --- | --- | --- |
| `APP_PORT` | Porta HTTP exposta no computador | `18080` |
| `DB_NAME` | Nome do banco MySQL | `php_login` |
| `DB_USER` | Usuário da aplicação no MySQL | `user_php_login` |
| `DB_PASS` | Senha do usuário da aplicação | `senha_local` |
| `DB_ROOT_PASS` | Senha administrativa do MySQL | `root_local` |

O arquivo `.env` é ignorado pelo Git. Em ambientes reais, use senhas fortes e
não publique esse arquivo.

## Estrutura principal

```text
publico/              ponto de entrada público da aplicação
scripts/              login, logout e páginas protegidas
inc/                  configuração, banco, rotas e componentes HTML
docker/mysql/init.sql criação da tabela e do usuário inicial
Dockerfile            imagem PHP com Apache e PDO MySQL
compose.yaml          aplicação e banco MySQL
```

O Apache publica somente a pasta `publico/`. Dessa forma, configurações,
scripts internos e arquivos de inicialização do banco não ficam acessíveis pela
web.
