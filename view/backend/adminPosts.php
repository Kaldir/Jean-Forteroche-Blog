<?php $title = 'Gestion des billets';
require('./view/pagination.php');
ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->
    
<!-- MODIFICATION DU POST -->
<h2>Ajout d'un billet</h2>

<div class="news">
    <form action="index.php?action=addPost" method="post">
        <div>
        	<label for="title">Titre</label><br />
            <input type="text" id="title" name="title" /><br />
            <label for="content">Contenu</label><br />
            <textarea id="content" name="content" /></textarea>
            <input type="submit" name="newPost" class="buttonStyle" value="Ajouter" />
        </div>
    </form>
</div>

<?php echo $pagination; ?>

<h2>Billets en ligne</h2>

<?php
while ($post = $posts->fetch()) {
?>

	<div class="news">
		<h3><?php echo htmlspecialchars($post['title']); ?></h3>
		<i class="smallInfosText">posté le <?php echo htmlspecialchars($post['creation_date']); ?></i>

		<a href="index.php?action=displayPostForm&amp;id=<?php echo htmlspecialchars($post['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

		<a href="index.php?action=deletePost&amp;id=<?php echo htmlspecialchars($post['id']); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce billet ?'));"><i class="fa fa-trash" aria-hidden="true"></i></a>

		<p><?php echo $post['content']; ?></p>
	</div>
<?php
}
$posts->closeCursor(); // Terminer le traitement de la requête
?>

<?php echo $pagination;
$content = ob_get_clean();
require('./view/backend/adminTemplate.php'); ?>