<?php $title = 'Gestion des commentaires';
ob_start(); ?>

<!-- AFFICHAGE DES COMMENTAIRES SIGNALES -->
<h2>Commentaires signalés</h2>

<?php
while ($comment = $comments->fetch()) {
?>
    <div class="news">
        <div class="commentStyle">
            <strong><?php echo htmlspecialchars($comment['author']); ?></strong>
            <i class="smallInfosText">- <?php echo htmlspecialchars($comment['comment_date_fr']); ?></i>

            <a href="index.php?action=displayCommentsForm&amp;id=<?php echo htmlspecialchars($comment['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

            <a href="index.php?action=deleteComment&amp;id=<?php echo htmlspecialchars($comment['id']); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce commentaire ?'));"><i class="fa fa-trash" aria-hidden="true"></i></a>

            <p><?php echo $comment['comment']; ?></p>
        </div>
        <p>En provenance du billet "<a href="index.php?action=adminPost&amp;id=<?php echo htmlspecialchars($comment['id_post']); ?>"><?php echo htmlspecialchars($comment['title']); ?></a>"</p>
    </div>
<?php
}
?>

<?php $content = ob_get_clean();
require('./view/backend/adminTemplate.php'); ?>