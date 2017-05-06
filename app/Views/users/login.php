<?php
require ROOT . '/core/HTML/Form.php';
require ROOT . '/core/HTML/BootstrapForm.php';
use \Core\HTML\BootstrapForm;

$form = new BootstrapForm();
?>

<form method="post">
    <?= $form->input('username', 'Pseudo'); ?>
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?> 
    <button class="btn btn-primary">Envoyer</button>
</form>