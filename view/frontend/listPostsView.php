<?php $title = 'Miniblog'; ?>

<?php ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

<div class="col-md-7">
	<p>Derniers billets du blog :</p>

	<!-- POSTS : affiche chaque entrée une à une (avec sécurité pour les failles XSS) -->
	<?php
	while ($data = $posts->fetch()) {
	?>
		<div class="news">
			<h3>
				<strong><?php echo htmlspecialchars($data['title']); ?></strong>
				<i>posté le <?php echo htmlspecialchars($data['creation_date']); ?></i>
			</h3>
			
			<?php echo $data['content']; ?>
			<a href="index.php?action=post&amp;id=<?php echo $data['id'] ?>">Commentaires</a>
		</div>
	<?php
	}
	$posts->closeCursor(); // Terminer le traitement de la requête
	?>
</div>
			
<?php $content = ob_get_clean(); ?> <!-- restitue le code html de la variable "content" (voir ligne 3) -->

<?php require('./view/template.php'); ?>