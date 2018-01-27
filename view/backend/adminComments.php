<?php $title = 'Gestion des commentaires'; ?>

<?php ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

<!-- CONNEXION ADMIN -->
<?php
if(!empty($post)) { // n'insère les entrées que si la variable data n'est pas vide
?>
    <div class="news">
        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
        <i class="smallInfosText">posté le <?php echo htmlspecialchars($post['creation_date']); ?> </i>
        <p>
        <?php echo nl2br (htmlspecialchars($post['content'])); ?> <!-- nl2br gère les retour à la ligne dans le contents -->
        </p>
    </div>
<?php
} else {
    echo "<p>Ce billet n'existe pas !</p>";
}
?>

<!-- AFFICHAGE DES COMMENTAIRES -->
<h2>Commentaires</h2>

<div>
    <form action="index.php?action=addComment&amp;id=<?php echo htmlspecialchars($post['id']); ?>" method="post" id="formComment">
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" /><br />
        <label for="comment">Commentaire</label><br />
        <textarea id="comment" name="comment"></textarea><br />
        <input type="submit" class="buttonStyle" />
    </form>

    <?php
    while ($comment = $comments->fetch()) {
        ?>
        <p>
            <strong><?php echo htmlspecialchars($comment['author']); ?></strong>
            <i class="smallInfosText">posté le <?php echo htmlspecialchars($comment['comment_date']); ?> </i>
            <a href="index.php?action=displayCommentsForm&amp;id=<?php echo htmlspecialchars($comment['id']); ?>">(modifier)</a>
            <?php echo nl2br(htmlspecialchars($comment['comment'])); ?>
        </p>
    <?php
    }
    ?>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./view/backend/adminTemplate.php'); ?>