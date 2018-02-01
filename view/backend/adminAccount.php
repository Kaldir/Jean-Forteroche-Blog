<?php $title = 'Gestion du compte administrateur';
ob_start(); ?>

<!-- CONNEXION ADMIN -->
<h2>Modification du pseudo</h2>

<div class="news">
    <form action="index.php?action=pseudoUpdate" method="post" id="connexionAdmin">
        <label for="pseudo">Pseudo actuel</label>
        <div><?php echo $_SESSION['pseudo']; ?></div><br />
        <label for="newPseudo">Nouveau pseudo</label>
        <input type="text" id="newPseudo" name="newPseudo" required /><br />
        <label for="password">Mot de passe actuel</label>
        <input type="password" id="password" name="password" required /><br />
        <input type="submit" name="connexion" class="buttonStyle" value="Connexion" />
    </form>
</div>

<h2>Modification du mot de passe</h2>

<div class="news">
    <form action="index.php?action=passUpdate" method="post" id="connexionAdmin">
        <label for="password">Mot de passe actuel</label>
        <input type="password" id="password" name="password" required /><br />
        <label for="newPassword">Nouveau mot de passe</label>
        <input type="password" id="newPassword" name="newPassword" required /><br />
        <label for="newPassword">Confirmation du nouveau mot de passe</label>
        <input type="password" id="checkPassword" name="checkPassword" required /><br />
        <input type="submit" name="connexion" class="buttonStyle" value="Connexion" />
    </form>
</div>

<?php $content = ob_get_clean();
require('./view/backend/adminTemplate.php'); ?>