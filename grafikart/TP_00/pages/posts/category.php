<?php

$app = App::getInstance();

$categorie = $app->getTable('Category')->find($_GET['id']);
if ($categorie === false)
	App::notFound();
$categorie = $app->getTable('Post')->lastByCategory($_GET['id']);
$categories = Categorie::all();

?>

<h1><?= $categorie->titre ?></h1>

<div class="row">
	<div class="col-sm-8">
		<?php foreach $articles as $post): ?>
			<h2><a href="<?= $post->url; ?>"><?= $post->titre; ?></a>, <?= $post->categorie; ?></h2>
			<p><?= $post->extrait; ?></p>
		<?php endforeach; ?>
	</div>
	<div class="col-sm-4">
		<?php foreach ($categories as $categorie): ?>
			<li><a href="<?= $categorie->url; ?>"><?= $categorie->contenu ?></a></li>
		<?php endforeach; ?>
	</div>
</div>