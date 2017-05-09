<?php
    define('ROOT', dirname(__DIR__));
    require ROOT . '/core/Autoloader.php';
    core\Autoloader::register();

    if ($_SESSION['auth'] !== null) {
        $page = 'index';
    } else if (isset($_GET['p'])) {
        $page = $_GET['p'];
    } else {
        $page = 'login';
    }

    ob_start();
    require ROOT . '/app/Views/users/' . $page . '.php';
    $content = ob_get_clean();
    require(ROOT . '/app/Views/templates/default.php');
?>