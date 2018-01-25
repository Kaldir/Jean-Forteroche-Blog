<?php $title = 'Gestion des billets'; ?>

<?php ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

    
<!-- MODIFICATION DU POST -->
<div class="col-md-7">
    <h2>Ajout d'un billet :</h2>

    <div class="news">
        <form action="index.php?action=addPost" method="post">
            <div>
            	<label for="title">Titre</label><br />
                <input type="text" id="title" name="title" />
                <label for="content">Contenu</label><br />
                <textarea id="content" name="content" /></textarea>
            </div>

            <div>
                <input type="submit" name="newPost" value="Ajouter" />
            </div>
        </form>
    </div>

    <?php
	while ($post = $posts->fetch()) {
	?>
		<div class="news">
			<h3>
				<strong><?php echo htmlspecialchars($post['title']); ?></strong>
				<i>- <?php echo htmlspecialchars($post['creation_date']); ?></i>

				<a href="index.php?action=displayPostForm&amp;id=<?php echo htmlspecialchars($post['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

				<a href="index.php?action=deletePost&amp;id=<?php echo htmlspecialchars($post['id']); ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
			</h3>

			<p><?php echo $post['content']; ?></p>
		</div>
	<?php
	}
	$posts->closeCursor(); // Terminer le traitement de la requête
	?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./view/backend/adminTemplate.php'); ?>