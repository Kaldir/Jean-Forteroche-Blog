<?php // CONTROLER
namespace Kldr\Blog\Controler;

// Chargement des classes
require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');

class FrontendControler
{
	public function listPosts($zone) {
		$postManager = new \Kldr\Blog\Model\PostManager(); // Création d'un objet
		$posts = $postManager->getPosts($zone); // Appel d'une méthode et de son argument
		$nbPost = $postManager->nbPost();

		require('./view/frontend/listPostsView.php');
	}

	public function post($postId, $signalised = false) {
		$postManager = new \Kldr\Blog\Model\PostManager();
		$commentManager = new \Kldr\Blog\Model\CommentManager();

		$post = $postManager->getPost($postId);
		$comments = $commentManager->getComments($postId);

		require('./view/frontend/postView.php');
	}

	public function addComment($postId, $author, $comment) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();

		$success = $commentManager->postComment($postId, $author, $comment);

		if ($success == false) {
	        throw new Exception('Impossible d\'ajouter le commentaire !'); // message d'erreur, erreur qui remonte jusqu'au bloc try du routeur (function $dbconnect -> model.php)
	    } else {
			header('Location: index.php?action=post&id=' . $postId);
	    }
	}

	public function displayCommentsForm($commentId) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$comment = $commentManager->selectComment($commentId);
		
		require('./view/backend/commentModify.php');
	}

	public function signal($commentId, $postId) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$commentManager->signalisedComment($commentId);
		header('Location: index.php?action=post&signaled&id=' . $postId);
	}
}