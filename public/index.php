<?php
    define('ROOT', dirname(__DIR__));
    include(ROOT . '/app/Views/templates/default.php');

    if (isset($_GET['p'])){
        $page = $_GET['p'];
    } else if ($_SESSION['auth'] !== null) {
        $page = 'index';
    } else {
        $page = 'login';
    }

    // if (isset($_GET['p']))
    // {
    //     $page = $_GET['p'];
    // }
    // else if ($_SESSION('auth') !== null)
    // {
    //     $page = 'index';
    // } 
    // else
    // {
    //     $page = 'login';
    // }

    if ($page == '')
?>