<?php // MODEL
namespace Kldr\Blog\Model;

require_once("Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId) // récupère les commentaires associés à un id de post
    {
		$db = $this->dbConnect();
	    $comments = $db->prepare('SELECT id, id_post, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date FROM comments WHERE id_post = ? ORDER BY comment_date DESC');
	    $comments->execute(array($postId));

    return $comments;
	}

	public function postComment($postId, $author, $comment) // fonction qui permet d'ajouter un commentaire
    {
	    $db = $this->dbConnect();
	    $comments = $db->prepare('INSERT INTO comments(id_post, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
	    $affectedLines = $comments->execute(array($postId, $author, $comment));

    return $affectedLines;
	}

	public function selectComment($commentId)
	{
		$db = $this->dbConnect();
		$comment = $db->prepare('SELECT id, comment, id_post FROM comments WHERE id = ?');
		$comment->execute(array($commentId));
		$comment = $comment->fetch();

	return $comment;
	}
}