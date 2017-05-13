<?php $form = new Form(); ?>
<h3>Sign up</h3><br>
<?php
	if (CB::my_assert($email_sent))
		echo $email_sent;
	if (CB::my_assert($wrong_password_confirmation))
		echo $wrong_password_confirmation;
	if (CB::my_assert($already_taken))
		echo $already_taken;
	if (CB::my_assert($invalid_email))
		echo $invalid_email;
?>

<form method="post" action="<?= Routeur::redirect('authsignup/signUp') ?>">
    <?= $form->input('login', 'Login'); ?>
    <?= $form->input('email', 'Email address'); ?>
    <?= $form->input('password', 'Password', ['type' => 'password']); ?> 
    <?= $form->input('password2', 'Password confirmation', ['type' => 'password']); ?> 
    <?= $form->submit('signup', 'Submit', 'btn btn-primary'); ?>
</form>

<hr>
<p>Already have an account? <a href='http://localhost:<?= PORT ?>/<?= Routeur::$url['dir']; ?>/authsignin/SignIn/'>Sign in</a></p>