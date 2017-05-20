<?php $form = new Form(); ?>

<h3>Reset your password</h3><br>

<form method="post", action="<?= Routeur::redirect('resetpwd/sendEmail'); ?>">
	<?= $form->input('login', 'Login'); ?>
	<?= $form->input('email', 'Email address'); ?>
	<?= $form->input('newPassword', 'New Password', ['type' => 'password']); ?>
	<?= $form->input('newPassword2', 'New Password confirmation', ['type' => 'password']); ?>
	<?= $form->submit('signup', 'Submit', 'btn btn-primary'); ?>
</form>