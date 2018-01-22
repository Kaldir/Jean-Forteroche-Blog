<?php $title = 'Accueil administrateur'; ?>

<?php ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

<!-- CONNEXION ADMIN -->
<div class="col-md-7">

	<div class="news">
	    <h2>Bienvenue sur l'interface administrateur !</h2>

	    <p>Vous pouvez ajouter, modifier ou supprimer des billets en cliquant sur le lien "Billets".<br />
	    Vous pouvez visualiser les commentaires signalés par les utilisateurs et les modifier ou supprimer en cliquant sur le lien "Commentaires".</p>
	</div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('adminTemplate.php'); ?>