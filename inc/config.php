<?php

// configuração do banco de dados via variáveis de ambiente
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'php_login');
define('DB_USER', getenv('DB_USER') ?: 'user_php_login');
define('DB_PASS', getenv('DB_PASS') ?: 'senha_local');
