<div class="row">
	<div class="col-sm-8">
		<?php foreach (App::getInstance()->getTable('Post')->last() as $post): ?>
			<h2><a href="<?= $post->url; ?>"><?= $post->titre; ?></a>, <?= $post->categorie; ?></h2>
			<p><?= $post->extrait; ?></p>
		<?php endforeach; ?>
	</div>
	<div class="col-sm-4">
		<?php foreach (App::getInstance()->getTable('Category')->all() as $categorie): ?>
			<li><a href="<?= $categorie->url; ?>"><?= $categorie->contenu ?></a></li>
		<?php endforeach; ?>
	</div>
</div>