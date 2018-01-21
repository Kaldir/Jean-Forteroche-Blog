<?php //CONTROLER
namespace Kldr\Blog\Controler;

// Chargement des classes
require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');

class BackendControler
{
	private function modifyComment($commentId, $comment, $postId) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();

	    $editComment = $commentManager->editComment($commentId, $comment);
	 
	    if ($editComment == false) {
	        throw new Exception('Impossible d\'éditer le commentaire');
	    }
	    else {
		    header('Location: index.php?action=post&id=' . $postId);
	    }
	}
}