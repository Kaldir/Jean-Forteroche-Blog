<?php //CONTROLER
namespace Kldr\Blog\Controler;

// Chargement des classes
require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');

class FrontendControler
{
	public function listPosts() {
		$postManager = new \Kldr\Blog\Model\PostManager(); // Création d'un objet
		$posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

		require('./view/frontend/listPostsView.php');
	}

	public function post() {
		$postManager = new \Kldr\Blog\Model\PostManager();
		$commentManager = new \Kldr\Blog\Model\CommentManager();

		$post = $postManager->getPost($_GET['id']);
		$comments = $commentManager->getComments($_GET['id']);

		require('./view/frontend/postView.php');
	}

	public function addComment($postId, $author, $comment) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();

		$affectedLines = $commentManager->postComment($postId, $author, $comment);

		if ($affectedLines == false) {
	        throw new Exception('Impossible d\'ajouter le commentaire !'); // message d'erreur, erreur qui remonte jusqu'au bloc try du routeur (function $dbconnect -> model.php)
	    } else {
			header('Location: index.php?action=post&id=' . $postId);
	    }
	}

	public function displayCommentsForm() {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$comment = $commentManager->selectComment($_GET['id']);
		
		require('./view/backend/commentModify.php');
	}
}