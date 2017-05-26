<?php $form = new Form(); ?>

<div style="text-align: center;">
	<h3><?= $username; ?>profile page</h3><br>
	<?= $images; ?>
</div>
<div class="total_like">
	<p><?= $nbLikes; ?> people loves your photos !</p>
</div>
<?php if ($_SESSION['auth'] === Routeur::$url['params'][0]){ ?>
	<script src="../../public/js/profile.js"></script><?php }?>