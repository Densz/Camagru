<?php $form = new Form($_POST); ?>

<form method="post">
    <?= $form->input('username', 'Login'); ?>
    <?= $form->input('password', 'Password', ['type' => 'password']); ?> 
    <?= $form->submit('Sign_in', 'Login', 'btn btn-primary'); ?>
</form>

<hr>
<p>Don't have an account? <a href="http://localhost:<?= PORT ?>/Camagru_AD/authsignup/View/">Sign up</a></p>