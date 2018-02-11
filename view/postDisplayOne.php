<?php $title = "JF - Billet et commentaires";
ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->

<input class="buttonStyle" onclick="window.history.back();" type="button" value="Retour" /> <!-- javascript qui permet le retour à la page précédente -->

<!-- AFFICHAGE DU BILLET -->
<div class="news">
    <h3><?php echo htmlspecialchars($post['title']); ?></h3> 
    <i class="smallInfosText">publié le <?php echo htmlspecialchars($post['creation_date_fr']); ?> </i>
<?php
if (!empty($_SESSION['admin'])) {
?>
    <a href="index.php?action=editPostForm&amp;id=<?php echo htmlspecialchars($post['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

    <a href="index.php?action=deletePost&amp;id=<?php echo htmlspecialchars($post['id']); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce billet ?'));"><i class="fa fa-trash" aria-hidden="true"></i></a>
<?php
}
?>
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

<?php
while ($comment = $comments->fetch()) {
?>
    <div class="commentStyle">
        <?php
        if ($comment['signalised'] && !empty($_SESSION['admin'])) {
        ?>
        <div class="adminSignalised">
            <i class="fa fa-exclamation-triangle"></i> Commentaire signalé par un utilisateur <i class="fa fa-exclamation-triangle"></i>
        </div>
        <?php    
        }
        if (empty($_SESSION['admin'])) {
        ?>
        <a href="index.php?action=signalComment&amp;id=<?php echo htmlspecialchars($comment['id']); ?>&amp;postId=<?php echo htmlspecialchars($_GET['id']); ?>"><i class="fa fa-exclamation-circle" aria-hidden="true"></i></a>
        <?php
        }
        ?>
        <strong><?php echo htmlspecialchars($comment['author']); ?></strong>
        <?php
        if (!empty($_SESSION['admin'])) {
        ?>
        <i class="smallInfosText">- <?php echo htmlspecialchars($comment['comment_date_fr']); ?></i>

        <a href="index.php?action=editCommentForm&amp;id=<?php echo htmlspecialchars($comment['id']); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

        <a href="index.php?action=deleteComment&amp;id=<?php echo htmlspecialchars($comment['id']); ?>" onclick="return(confirm('Etes-vous sûr de vouloir supprimer ce commentaire ?'));"><i class="fa fa-trash" aria-hidden="true"></i></a>
        <?php
        }
        ?>
        <p><?php echo $comment['comment']; ?></p>
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

<?php $content = ob_get_clean(); ?>