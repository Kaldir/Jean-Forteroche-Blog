<?php $title = "Billet et commentaires";
ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

<a href="index.php?action=displayAllPostsAdmin" class="buttonStyle">Retour</a>

<!-- AFFICHAGE DU BILLET -->
<?php
if(!empty($post)) { // n'insère les entrées que si la variable post n'est pas vide
?>
    <div class="news">
        <h3><?php echo htmlspecialchars($post['title']); ?></h3> 
        <i class="smallInfosText">publié le <?php echo htmlspecialchars($post['creation_date_fr']); ?> </i>

        <a href="index.php?action=editPostForm&amp;id=<?php echo htmlspecialchars($post['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

        <a href="index.php?action=deletePost&amp;id=<?php echo htmlspecialchars($post['id']); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce billet ?'));"><i class="fa fa-trash" aria-hidden="true"></i></a>

        <?php echo nl2br($post['content']); ?>
    </div>
<?php
} else {
    header('Location: adminIndex.php'); // si un id de billet inexistant est rentré manuellement dans l'url, l'user est redirigé sur la page d'accueil)
}
?>

<!-- AFFICHAGE DES COMMENTAIRES -->
<h2>Commentaires</h2>

<?php
if (!empty($post)) { // n'insère les entrées que si la variable post n'est pas vide
?>
    <div id="commentDisplay">
    <?php
    while ($comment = $comments->fetch()) {
    ?>
        <div class="commentStyle">
            <?php
            if ($comment['signalised']) {
            ?>
            <div class="adminSignalised">
                <i class="fa fa-exclamation-triangle"></i> Commentaire signalé par un utilisateur <i class="fa fa-exclamation-triangle"></i>
            </div>
            <?php    
            }
            ?>
            <strong><?php echo htmlspecialchars($comment['author']); ?></strong>
            <i class="smallInfosText">- <?php echo htmlspecialchars($comment['comment_date_fr']); ?></i>

            <a href="index.php?action=editCommentForm&amp;id=<?php echo htmlspecialchars($comment['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

            <a href="index.php?action=deleteComment&amp;id=<?php echo htmlspecialchars($comment['id']); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce commentaire ?'));"><i class="fa fa-trash" aria-hidden="true"></i></a>

            <p><?php echo $comment['comment']; ?></p>
        </div>
    <?php
    }
    ?>
</div>
<?php
}
?>

<?php $content = ob_get_clean();
require('./view/backend/adminTemplate.php');
?>