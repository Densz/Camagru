<?php
    define('ROOT', dirname(__DIR__));
    require ROOT . '/app/App.php';

    if (isset($_GET['p'])){
        $page = $_GET['p'];
    } else if ($_SESSION['auth'] !== null) {
        $page = 'index';
    } else {
        $page = 'login';
    }

    ob_start();
    if ($page === 'login') {
        require ROOT . '/app/Views/users/login.php';
    } else {
        require ROOT . '/app/Views/users/index.php';
    }
    $content = ob_get_clean();
    require(ROOT . '/app/Views/templates/default.php');
?>