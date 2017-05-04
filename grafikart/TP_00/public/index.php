<?php

	define ('ROOT', dirname(__DIR__))
	require ROOT . '/app/App.php';
	require '../app/Autoloader.php';

	App::load();
	$app = App::getInstance();
	App\Autoloader::register();
	$post = App\App::getTable('Posts');
	$config = new App\Config::getInstance()->get('db_user');
	if (isset($_GET['p']))
		$p = $_GET['p'];
	else
		$p = 'home';

	ob_start();
	if ($p === 'home')
		require ROOT . '/pages/posts/home.php';
	else if ($p === 'post.category')
		require ROOT . '/pages/posts/category.php';
	else if ($p === 'post.show')
		require ROOT . '/pages/posts/show.php';
	$content = ob_get_clean();
	require ROOT . '/pages/templates/default.php';
?>
