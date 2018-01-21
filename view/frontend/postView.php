<?php $title = "Commentaires" ?>

<?php ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

<div>
    <button type="submit" id="return"><a href="index.php"><i class="fa fa-hand-o-left" aria-hidden="true"></i> Retour à la liste des billets</a></button>
</div>

<!-- AFFICHAGE DU BILLET -->
<div class="col-md-7">
    <?php
    if(!empty($post)) { // n'insère les entrées que si la variable data n'est pas vide
    ?>
        <div class="news">
            <h3>
                <strong><?php echo htmlspecialchars($post['title']); ?> </strong>
                <i>posté le <?php echo htmlspecialchars($post['creation_date']); ?> </i>
            </h3>
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
    <div id="commentDisplay" class="row">
        <h2>Commentaires</h2>

        <form action="index.php?action=addComment&amp;id=<?php echo htmlspecialchars($post['id']); ?>" method="post" id="formComment">
            <div id="commentView">
                <label for="author">Auteur</label><br />
                <input type="text" id="author" name="author" />
            </div>
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea id="comment" name="comment"></textarea>
            </div>
            <div>
                <input type="submit" id="submitComment" />
            </div>
        </form>

        <?php
        while ($comment = $comments->fetch()) {
            ?>
            <p>
                <strong><?php echo htmlspecialchars($comment['author']); ?></strong>
                <i>posté le <?php echo htmlspecialchars($comment['comment_date']); ?> </i>
                <a href="index.php?action=displayCommentsForm&amp;id=<?php echo htmlspecialchars($comment['id']); ?>">(modifier)</a>
                <?php echo nl2br(htmlspecialchars($comment['comment'])); ?> <!-- nl2br gère les retour à la ligne dans le contents -->
            </p>
        <?php
        }
        ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>