<?php $form = new Form($_POST); ?>
<h3>Sign in</h3><br>
<?php
	if (CB::my_assert($wrong_pwd))
		echo $wrong_pwd;
	if (CB::my_assert($wrong_log))
		echo $wrong_log;
	if (CB::my_assert($no_access))
		echo $no_access;
	if (CB::my_assert($alert_disconnected))
		echo $alert_disconnected;
	if (CB::my_assert($email_not_confirmed))
		echo $email_not_confirmed;
?>
<form method="post" action="<?= Routeur::redirect("Authsignin/signin"); ?>">
    <?= $form->input('login', 'Login'); ?>
    <?= $form->input('password', 'Password', ['type' => 'password']); ?> 
    <?= $form->submit('sign_in', 'Login', 'btn btn-primary'); ?>
</form>

<hr>
<p>Don't have an account? <a href="http://localhost:<?= PORT ?>/<?= Routeur::$url['dir'] ?>/authsignup/View/">Sign up</a></p>