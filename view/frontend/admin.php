<?php $title = 'Connexion administrateur'; ?>

<?php ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

<!-- CONNEXION ADMIN -->
<h2>Connexion administrateur</h2>

<div class="news">
    <form action="index.php?action=login" method="post" id="connexionAdmin">
        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" required />
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required />
        <input type="submit" name="connexion" class="buttonStyle" value="Connexion" />
    </form>
</div>

<?php echo $message ?>

<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>