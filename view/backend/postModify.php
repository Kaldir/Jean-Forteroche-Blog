<?php $title = 'Modifier un billet'; ?>

<?php ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->
           
<!-- MODIFICATION DU COMMENTAIRE -->
<div class="col-md-7">
    <h2>Modification du billet:</h2>
    <a href="./view/backend/admin.php">Annuler</a>

    <div class="news">
        <form action="index.php?action=&amp;id=<?= $_GET['id'] ?>" method="post">
            <div>
                <label for="title">Titre</label><br />
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title'] )?>" /><br />
                <label for="content">Contenu</label><br />
                <textarea id="content" name="content"><?php echo $post['content'] ?></textarea>
            </div>

            <div>
                <input type="submit" name="newPost" value="Modifier" />
            </div>
        </form>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('./view/backend/adminTemplate.php'); ?>