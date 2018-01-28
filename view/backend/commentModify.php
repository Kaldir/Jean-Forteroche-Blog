<?php $title = 'Modifier un commentaire'; ?>

<?php ob_start(); ?>
           
<!-- MODIFICATION DU COMMENTAIRE -->
<h2>Modifier le commentaire</h2>
<a href="index.php" class="buttonStyle">Annuler</a>

<div class="news">
    <form action="index.php?action=editForm&amp;id=<?= $_GET['id'] ?>" method="post">
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment" name="comment" /><?php echo nl2br(htmlspecialchars($comment['comment'])) ?></textarea>
            <input name="id_post" type="hidden" value="<?php echo (htmlspecialchars($comment['id_post'])) ?>"/ >
            <input type="submit" class="buttonStyle" name="newComment" value="Modifier" />
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>