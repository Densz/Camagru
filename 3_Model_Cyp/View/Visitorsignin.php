<?php
$form = new BootstrapForm($_POST);
?>

<form method="post">
    <?= $form->input('username', 'Login'); ?>
    <?= $form->input('password', 'Password', ['type' => 'password']); ?> 
    <button class="btn btn-primary">Log In</button>
</form>

<hr>
<p>Don't have an account? <a href="http://e2r5p7.42.fr:8080/Camagru_AD/3_Model_Cyp/visitorsignup/View/">Sign up</a></p>