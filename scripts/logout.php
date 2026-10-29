<?php

// destrói os dados e o cookie da sessão
$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
}

session_destroy();

// redireciona para a página inicial
header('Location: index.php?rota=home');
exit;
