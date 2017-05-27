<?php $form = new Form(); ?>

<div style="text-align: center;">
	<h3><?= $username; ?></h3><br>
	<div class="total_like">
		<p><?= $nbLikes; ?> people love<?php if ($nbLikes === 1) { echo 's'; } ?> your photos !</p>
	</div>
	<?= $images; ?>
</div>

<?php if ($_SESSION['auth'] === Routeur::$url['params'][0]){ ?>
	<script src="../../public/js/profile.js"></script><?php }?>