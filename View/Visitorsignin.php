<?php
$form = new BootstrapForm($_POST);
?>

<form method="post">
    <?= $form->input('username', 'Login'); ?>
    <?= $form->input('password', 'Password', ['type' => 'password']); ?> 
    <button class="btn btn-primary">Log In</button>
</form>

<hr>
<p>Don't have an account? <a href="http://localhost:<?= PORT ?>/Camagru_AD/visitorsignup/View/">Sign up</a></p>