<?php $title = 'Gestion des billets'; ?>

<?php ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

    
<!-- MODIFICATION DU POST -->
<div class="col-md-7">
    <h2>Ajout d'un billet :</h2>

    <div class="news">
        <form action="index.php?action=addPost" method="post">
            <div>
            	<label for="title">Titre</label><br />
                <input id="title" name="title" />
                <label for="content">Contenu</label><br />
                <textarea id="content" name="content" /></textarea>
            </div>

            <div>
                <input type="submit" name="newPost" value="Ajouter" />
            </div>
        </form>
    </div>

    <?php
	while ($data = $posts->fetch()) {
	?>
		<div class="news">
			<h3>
				<strong><?php echo htmlspecialchars($data['title']); ?></strong>
				<i>posté le <?php echo htmlspecialchars($data['creation_date']); ?></i>
			</h3>

			<p><?php echo $data['content']; ?></p>
		</div>
	<?php
	}
	$posts->closeCursor(); // Terminer le traitement de la requête
	?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./view/backend/adminTemplate.php'); ?>