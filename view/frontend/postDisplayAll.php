<?php $title = 'Miniblog';
require('./view/pagination.php');
ob_start(); // Permet de mémoriser le code html qui suit en le mettant dans la variable "content"
echo $pagination; ?>

<h2>Dernières publications</h2>

<!-- POSTS : affiche chaque entrée une à une (avec sécurité pour les failles XSS) -->
<?php
while ($data = $posts->fetch()) {
?>
	<div class="news">
		<h3><?php echo htmlspecialchars($data['title']); ?></h3>
		<i class="smallInfosText">publié le <?php echo htmlspecialchars($data['creation_date_fr']); ?></i>
		<p><?php echo $postManager->getExcerpt($data['content']); ?></p>
		<a class="buttonStyle" href="index.php?action=displayOnePostUser&amp;id=<?php echo htmlspecialchars($data['id']); ?>">Lire la suite...</a>
	</div>
<?php
}
$posts->closeCursor(); // Termine le traitement de la requête
?>

<?php echo $pagination;		
$content = ob_get_clean(); // restitue le code html de la variable "content" (voir ligne 3)
require('./view/frontend/template.php'); ?>