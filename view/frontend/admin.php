<?php $title = 'Connexion administrateur'; ?>

<?php ob_start(); ?>

<!-- CONNEXION ADMIN -->
<h2>Connexion administrateur</h2>

<div class="news">
    <form action="index.php?action=login" method="post" id="connexionAdmin">
        <label for="pseudo">Pseudo</label>
        <input type="text" id="pseudo" name="pseudo" required /><br />
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required /><br />
        <input type="submit" name="connexion" class="buttonStyle" value="Connexion" />
    </form>
</div>

<?php echo $message ?> <!-- Affiche un message d'erreur si le mdp et/id sont incorrects -->

<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>