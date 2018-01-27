<?php // Model
namespace Kldr\Blog\Model;

require_once("Manager.php");

class PostManager extends Manager
{
    public function getPosts() { // renvoie la liste des posts
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId) { // récuperation d'un post en fonction de son id
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y (%Hh%imin%ss)\') AS creation_date FROM posts WHERE id = ?');
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

    public function selectPost($postId) {
        $db = $this->dbConnect();
        $post = $db->prepare('SELECT id, title, content FROM posts WHERE id = ?');
        $post->execute(array($postId));
        $post = $post->fetch();
    
        return $post;
    }

    public function editPost($title, $content, $postId) { // fonction qui permet de modifier un post
        $db = $this->dbConnect();
        $post = $db->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ?');
        $modify = $post->execute(array($title, $content, $postId));
    
        return $modify;
    }

    public function deletePost($postId) {
        $db = $this->dbConnect();
        $post = $db->prepare('DELETE FROM posts WHERE id = ?');
        $delete = $post->execute(array($postId));

        return $delete;    
    }
}