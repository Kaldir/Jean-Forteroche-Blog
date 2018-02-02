<?php $title = 'Gestion des commentaires';
ob_start(); ?>

<!-- AFFICHAGE DES BILLETS AYANT DES COMMENTAIRES SIGNALES -->
<?php
if(!empty($post)) { // n'insère les entrées que si la variable data n'est pas vide
?>
    <div class="news">
        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
        <i class="smallInfosText">posté le <?php echo htmlspecialchars($post['creation_date_fr']); ?> </i>
        <p>
        <?php echo nl2br (htmlspecialchars($post['content'])); ?> <!-- nl2br gère les retour à la ligne dans le contents -->
        </p>
    </div>
<?php
} else {
    echo "<p>Ce billet n'existe pas !</p>";
}
?>

<!-- AFFICHAGE DES COMMENTAIRES SIGNALES -->
<h2>Commentaires signalés</h2>

<div>
    <?php
    while ($comment = $comments->fetch()) {
        ?>
        <p>
            <strong><?php echo htmlspecialchars($comment['author']); ?></strong>
            <i class="smallInfosText">posté le <?php echo htmlspecialchars($comment['comment_date']); ?> </i>

            <a href="index.php?action=displayCommentsForm&amp;id=<?php echo htmlspecialchars($comment['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

            <a href="index.php?action=deletePost&amp;id=<?php echo htmlspecialchars($comment['id']); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce commentaire ?'));"><i class="fa fa-trash" aria-hidden="true"></i></a>

            <?php echo nl2br(htmlspecialchars($comment['comment'])); ?>
        </p>
    <?php
    }
    ?>
</div>

<?php $content = ob_get_clean();
require('./view/backend/adminTemplate.php'); ?>