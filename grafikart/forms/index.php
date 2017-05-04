<?php
	require_once './class/Autoloader.php';
	\Tutoriel\Autoloader::register();
	$form = new \Tutoriel\bootstrapForm($_POST);
?>

<form action="#"" method="post">
	<?php
		echo $form->input('username');
		echo $form->input('password');
		echo $form->submit();
	?>
</form>