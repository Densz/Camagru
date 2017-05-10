<?php $form = new Form(); ?>

<form method="post" action="http://localhost:<?= PORT ?>/<?= Routeur::$url['dir']; ?>/authsignup/signUp/">
    <?= $form->input('login', 'Login'); ?>
    <?= $form->input('email', 'Email address'); ?>
    <?= $form->input('password', 'Password', ['type' => 'password']); ?> 
    <?= $form->input('password2', 'Password confirmation', ['type' => 'password']); ?> 
    <?= $form->submit('signup', 'Submit', 'btn btn-primary'); ?>
</form>

<hr>
<p>Already have an account? <a href='http://localhost:<?= PORT ?>/<?= Routeur::$url['dir']; ?>/authsignin/View/'>Sign in</a></p>