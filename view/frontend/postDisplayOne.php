<?php $title = "Commentaires";
ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

<a href="index.php" class="buttonStyle">Retour</a>

<!-- AFFICHAGE DU BILLET -->
    <div class="news">
        <h3><?php echo htmlspecialchars($post['title']); ?></h3>        
        <i class="smallInfosText">publié le <?php echo htmlspecialchars($post['creation_date_fr']); ?> </i>
        <?php echo nl2br($post['content']); ?>
    </div>

<!-- AFFICHAGE DES COMMENTAIRES -->
<h2>Commentaires</h2>

<div id="commentDisplay">
    <form action="index.php?action=addComment&amp;id=<?php echo htmlspecialchars($post['id']); ?>" method="post" id="formComment">
        <label for="author">Auteur</label><br />
        <input type="text" id="author" name="author" />
        <label for="comment">Commentaire</label><br />
        <input id="comment" name="comment"></input>
        <input type="submit" class="buttonStyle" />
    </form>

    <p class="smallInfosText">En cliquant sur l'icône <i class="fa fa-exclamation-circle" aria-hidden="true"></i>, vous pouvez signaler un commentaire à l'administrateur.</p>

    <?php
    while ($comment = $comments->fetch()) {
        ?>
        <div class="commentStyle">
            <a href="index.php?action=signalComment&amp;id=<?php echo htmlspecialchars($comment['id']); ?>&amp;postId=<?php echo htmlspecialchars($_GET['id']); ?>"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></a>
            <strong><?php echo htmlspecialchars($comment['author']); ?></strong>
            <i class="smallInfosText">- <?php echo htmlspecialchars($comment['comment_date_fr']); ?></i>
            <p><?php echo htmlspecialchars($comment['comment']); ?></p>
        </div>
    <?php
    }
    ?>
</div>

<?php
if ($signalised) {
?>
<div id="modalSignal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <p>Vous venez de signaler un commentaire : l'administrateur prendra cette information en compte dès que possible, merci !</p>
        <button type="button" class="btn btn-secondary buttonStyle" data-dismiss="modal">Ok !</button>
      </div>
    </div>
</div>
<?php
}
?>

<?php $content = ob_get_clean();
require('./view/frontend/template.php');

// on déclare ce script après l'exécution de Jquery qui se trouve dans template.php
if ($signalised) {
?>
    <script> $('#modalSignal').modal('show'); </script> <!-- display la modal lorsqu'un commentaire est signalé (passe en true dans la bdd) -->
<?php
}
?>