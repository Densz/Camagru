<?php $form = new Form($_POST); ?>

<form method="post" action="http://localhost:<?= PORT ?>/<?= Routeur::$url['dir']; ?>/authsignin/signIn/">
    <?= $form->input('login', 'Login'); ?>
    <?= $form->input('password', 'Password', ['type' => 'password']); ?> 
    <?= $form->submit('sign_in', 'Login', 'btn btn-primary'); ?>
</form>

<hr>
<p>Don't have an account? <a href="http://localhost:<?= PORT ?>/<?= Routeur::$url['dir'] ?>/authsignup/View/">Sign up</a></p>