<?php
$form = new BootstrapForm($_POST);
?>

<form method="post">
    <?= $form->input('username', 'Login'); ?>
    <?= $form->input('password', 'Password', ['type' => 'password']); ?> 
    <button class="btn btn-primary">Log In</button>
</form>

<hr>
<p>Don't have an account? <a href="index.php?p=sign_up">Sign up</a></p>