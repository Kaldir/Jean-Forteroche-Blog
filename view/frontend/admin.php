<?php $title = 'Connexion administrateur';
ob_start(); ?>

<!-- CONNEXION ADMIN -->
<h2>Connexion administrateur</h2>

<div class="news">
    <form action="index.php?action=login" method="post" id="connexionAdmin">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required /><br />
        <label for="password">Mot de passe</label>
        <input type="password" id="password" name="password" required /><br />
        <input type="submit" name="connexion" class="buttonStyle" value="Connexion" />
    </form>
</div>

<?php
if ($message) { // Affiche un message d'erreur si le mdp et/id sont incorrects
?>
<div class="news">
	<p>Votre identifiant ou votre mot de passe est incorrect !</p>
</div>
<?php
}
?>

<?php $content = ob_get_clean();
require('./view/template.php'); ?>