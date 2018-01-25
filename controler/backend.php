<?php // CONTROLER
namespace Kldr\Blog\Controler;

// Chargement des classes
require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');

class BackendControler
{
	public function adminViewPosts() {
		$postManager = new \Kldr\Blog\Model\PostManager(); // Création d'un objet
		$posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

		require('./view/backend/adminPosts.php');
	}

	public function addPost($title, $content) {
			$postManager = new \Kldr\Blog\Model\PostManager();

			$success = $postManager->postPost($title, $content);

			if ($success == false) {
		        throw new Exception('Impossible d\'ajouter le billet !'); // message d'erreur, erreur qui remonte jusqu'au bloc try du routeur (function $dbconnect -> model.php)
		    } else {
				header('Location: index.php?action=adminViewPosts');
		    }
	}

	public function modifyComment($commentId, $comment, $postId) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();

	    $editComment = $commentManager->editComment($commentId, $comment);
	 
	    if ($editComment == false) {
	        throw new Exception('Impossible d\'éditer le commentaire');
	    }
	    else {
		    header('Location: index.php?action=post&id=' . $postId);
	    }
	}

	public function displayPostForm($postId) {
		$postManager = new \Kldr\Blog\Model\PostManager();
	    $post = $postManager->selectPost($postId);

		require('./view/backend/postModify.php');

	    if ($post == false) {
	        throw new Exception('Impossible d\'éditer le billet');
	    }
	}

	public function editPost($title, $content, $postId) {
			$postManager = new \Kldr\Blog\Model\PostManager();

			$success = $postManager->editPost($title, $content, $postId);

			if ($success == false) {
		        throw new Exception('Impossible d\'éditer le billet !'); // message d'erreur, erreur qui remonte jusqu'au bloc try du routeur (function $dbconnect -> model.php)
		    } else {
				header('Location: index.php?action=adminViewPosts');
		    }
	}

	public function deletePost($postId) {
		$postManager = new \Kldr\Blog\Model\PostManager();
	    $deletePost = $postManager->deletePost($postId);
	 
		header('Location: index.php?action=adminViewPosts');
	}

	public function adminForm($message = '') {
		require('./view/frontend/admin.php');
	}

	public function adminIndex() {
		require('./view/backend/adminIndex.php');
	}

	public function adminPosts() {
		require('./view/backend/adminPosts.php');
	}

	public function adminComments() {
		require('./view/backend/adminComments.php');
	}
}