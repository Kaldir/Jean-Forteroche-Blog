<?php $title = 'Accueil administrateur'; ?>

<?php ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

<!-- CONNEXION ADMIN -->
<h2>Bienvenue sur l'interface administrateur !</h2>

<div class="news">
    <p>Vous pouvez ajouter, modifier ou supprimer des billets en cliquant sur le lien "Billets".<br />
    Vous pouvez visualiser les commentaires signalés par les utilisateurs et les modifier ou supprimer en cliquant sur le lien "Commentaires".</p>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('adminTemplate.php'); ?>