<?php $title = 'Connexion administrateur'; ?>

<?php ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

<!-- CONNEXION ADMIN -->
<div class="col-md-7">

	<div class="news">
	    <h2>Connexion</h2>

	    <form action="index.php?action=listPosts" method="post"> <!-- appelle la variable id avec a variable GET (voir postView.php - ligne 50) -->
	        <div>
	            <label for="pseudo">Pseudo</label><br />
	            <input type="text" id="pseudo" name="pseudo" required />
	            <label for="pseudo">Mot de passe</label><br />
	            <input type="password" id="password" name="password" required />         
	        </div>

	        <div>
	            <input type="submit" name="connexion" value="Connexion" />
	        </div>
	    </form>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>