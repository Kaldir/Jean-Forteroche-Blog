<?php $title = 'Gestion des commentaires'; ?>

<?php ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

<!-- CONNEXION ADMIN -->
<div class="col-md-7">

	<div class="news">
	    
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./view/backend/adminTemplate.php'); ?>