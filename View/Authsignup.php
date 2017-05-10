<?php $form = new Form(); ?>

<form method="post" action="http://localhost:<?= PORT ?>/Camagru_AD/authsignup/signUp/">
    <?= $form->input('username', 'Login'); ?>
    <?= $form->input('email', 'Email address'); ?>
    <?= $form->input('password', 'Password', ['type' => 'password']); ?> 
    <?= $form->input('password2', 'Password confirmation', ['type' => 'password']); ?> 
    <?= $form->submit('signup', 'Submit', 'btn btn-primary'); ?>
</form>

<hr>
<p>Already have an account? <a href='http://localhost:<?= PORT ?>/Camagru_AD/authsignin/View/'>Sign in</a></p>