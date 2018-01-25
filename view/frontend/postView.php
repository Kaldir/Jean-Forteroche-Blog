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
            
            <?php echo nl2br($post['content']); ?>
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

        <p>En cliquant sur cette icone <i class="fa fa-exclamation-circle" aria-hidden="true"></i>, vous pouvez signaler un commentaire inadapté à l'administrateur du site.</p>

        <?php
        while ($comment = $comments->fetch()) {
            ?>
            <p>
                <a href="index.php?action=signalComment&amp;id=<?php echo htmlspecialchars($comment['id']); ?>&amp;postId=<?php echo htmlspecialchars($_GET['id']); ?>"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></a>
                <strong><?php echo htmlspecialchars($comment['author']); ?></strong>
                <i>posté le <?php echo htmlspecialchars($comment['comment_date']); ?> </i>
                <?php echo nl2br(htmlspecialchars($comment['comment'])); ?> <!-- nl2br gère les retour à la ligne dans le contents -->
            </p>
        <?php
        }
        ?>
    </div>
</div>

<?php
if ($signalised) {
    ?>
    <div id="modalSignal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          </div>
          <div class="modal-body">
            <p>Vous venez de signaler un commentaire : l'administrateur prendra cette information en compte dès que possible, merci !</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Ok !</button>
          </div>
        </div>
      </div>
    </div>
<?php
}
?>

<?php
if ($signalised) {
    ?>
        <script> $('#modalSignal').modal('show'); </script>
<?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>