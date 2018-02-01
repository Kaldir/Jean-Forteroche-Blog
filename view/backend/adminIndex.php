<?php $title = 'Accueil administrateur';
ob_start(); ?>

<!-- CONNEXION ADMIN -->
<h2>Bienvenue sur l'interface administrateur <?php echo $_SESSION['pseudo']; ?> !</h2>

<div class="news">
    <p>Vous pouvez ajouter, modifier ou supprimer des billets en cliquant sur le lien "Billets".<br />
    Vous pouvez visualiser les commentaires signalés par les utilisateurs et les modifier ou supprimer en cliquant sur le lien "Commentaires".</p>
</div>

<?php $content = ob_get_clean();
require('./view/backend/adminTemplate.php'); ?>