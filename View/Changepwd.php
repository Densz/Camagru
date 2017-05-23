<?php $form = new Form(); ?>

<form method="post" action="<?= Routeur::redirect('Changepwd/updatepwd') ;?>">
	<?= $form->input('password', 'New password', ['type' => 'password']); ?>
	<?= $form->input('password2', 'New password confirmation', ['type' => 'password']);?>
	<?= $form->input('email', "'" . Routeur::$url['params'][0] . "'", ['type' => '']); ?>
	<?= $form->submit('reset', 'Reset', 'btn btn-primary'); ?>
</form>
