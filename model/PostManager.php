<?php // Model
namespace Kldr\Blog\Model;

require_once("Manager.php");

class PostManager extends Manager
{
    public function getPosts($zone) { // renvoie la liste des posts
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT ?, 5');
        $req->bindValue(1, $zone, \PDO::PARAM_INT); // permet d'insérer la variable $zone dans la requête sql (en tant que nombre et pas string)
        $req->execute();

        return $req;
    }

    public function getPost($postId) { // récuperation d'un post en fonction de son id
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();
        
        return $post;
    }

    public function postPost($title, $content) { // ajout d'un post
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO posts(title, content, creation_date) VALUES (?, ?, NOW())');
        $affectedLines = $post->execute(array($title, $content));
   
        return $affectedLines;
    }

    public function editPost($title, $content, $postId) { // fonction qui permet de modifier un post
        $db = $this->dbConnect();
        $post = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $modify = $post->execute(array($title, $content, $postId));
    
        return $modify;
    }

    public function deletePost($postId) { // permet de supprimer un billet et ses commentaires associés de la bdd
        $db = $this->dbConnect();
        $comment = $db->prepare('DELETE FROM comments WHERE id_post = ?');
        $comment->execute(array($postId));
        $post = $db->prepare('DELETE FROM posts WHERE id = ?');
        $delete = $post->execute(array($postId));

        return $delete;
    }

    public function nbPost() { // Compte le nombre total de billets contenu dans la bdd
        $db = $this->dbConnect();
        $req = $db->query('SELECT COUNT(*) FROM posts');
        $req = $req->fetchColumn();

        return $req;
    }

    public function getExcerpt($string, $start = 0, $maxLength = 300) { // Affiche un extrait d'un billet et donne des valeurs par défaut qui sont modifiable lorsque on fait appel à la méthode (à cause de tinyMCE, il faut penser à prendre en compte les balises html, non visible sur le site mais considérées par le maxLength)
        if (strlen($string) > $maxLength) { // si le texte est supérieur à 100 caractères
            $string = substr($string, $start, $maxLength); // affiche le texte, depuis le premier caractère, jusqu'à 100 caractères
            $string  .= '...';
        }
        return $string;
    }
}