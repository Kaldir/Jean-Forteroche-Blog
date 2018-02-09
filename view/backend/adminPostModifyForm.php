<?php $title = 'Modifier un billet';
ob_start(); ?> <!-- Permet de mémoriser le code html qui suit en le mettant dans la variable "content" -->
           
<!-- MODIFICATION DU COMMENTAIRE -->
<h2>Modifier le billet</h2>
<a href="index.php?action=displayAllPostsAdmin" class="buttonStyle">Annuler</a>

<div class="news">
    <form action="index.php?action=editPost&amp;id=<?= $_GET['id'] ?>" method="post">
        <div>
            <label for="title">Titre</label><br />
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title'] )?>" /><br />
            <label for="content">Contenu</label><br />
            <textarea id="content" name="content"><?php echo $post['content'] ?></textarea>
        </div>

        <div>
            <input type="submit" name="newPost" class="buttonStyle" value="Modifier" />
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>