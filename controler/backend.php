<?php // CONTROLER - ADMIN
namespace Kldr\Blog\Controler;

require_once('./controler/main.php');

class BackendControler extends MainControler
{

// POSTS
	public function adminIndex() {
		require('./view/backend/adminIndex.php');
	}

	public function adminPosts() {
		require('./view/backend/adminPostDisplayAll.php');
	}

	public function displayAllPostsAdmin($zone = 0) {
		$postManager = new \Kldr\Blog\Model\PostManager(); // Création d'un objet
		$posts = $postManager->getPosts($zone); // Appel d'une fonction de cet objet
		$nbPost = $postManager->nbPost();
		require('./view/backend/adminPostDisplayAll.php');
	}

	public function displayOnePostAdmin($postId) {
		$postManager = new \Kldr\Blog\Model\PostManager();
		$commentManager = new \Kldr\Blog\Model\CommentManager();

		$post = $postManager->getPost($postId);
		$comments = $commentManager->getComments($postId);

		require('./view/backend/adminPostDisplayOne.php');
		}

	public function editPostForm($postId) {
		$postManager = new \Kldr\Blog\Model\PostManager();
	    $post = $postManager->getPost($postId);
		require('./view/backend/adminPostModifyForm.php');
	    if ($post == false) {
	        throw new Exception('Impossible d\'éditer le billet');
	    }
	}

	public function addPost($title, $content) {
			$postManager = new \Kldr\Blog\Model\PostManager();
			$success = $postManager->postPost($title, $content);
			if ($success == false) {
		        throw new Exception('Impossible d\'ajouter le billet !'); // message d'erreur, erreur qui remonte jusqu'au bloc try du routeur (function $dbconnect -> model.php)
		    } else {
				header('Location: index.php?action=displayAllPostsAdmin');
		    }
	}

	public function editPost($title, $content, $postId) {
			$postManager = new \Kldr\Blog\Model\PostManager();
			$success = $postManager->editPost($title, $content, $postId);
			if ($success == false) {
		        throw new Exception('Impossible d\'éditer le billet !'); // message d'erreur, erreur qui remonte jusqu'au bloc try du routeur (function $dbconnect -> model.php)
		    } else {
				header('Location: index.php?action=displayAllPostsAdmin');
		    }
	}

	public function deletePost($postId) {
		$postManager = new \Kldr\Blog\Model\PostManager();
	    $deletePost = $postManager->deletePost($postId);
	 	header('Location: index.php?action=displayAllPostsAdmin');
	}

// COMMENTS
	public function adminComments() {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$comments = $commentManager->getCommentsSignalised();
		require('./view/backend/adminComments.php');
	}

	public function editComment($commentId, $comment) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
	    $editComment = $commentManager->editComment($commentId, $comment);
	    if ($editComment == false) {
	        throw new Exception('Impossible d\'éditer le commentaire');
	    }
	    else {
		    header('Location: index.php?action=displaySignalisedCommentsAdmin');
	    }
	}

	public function deleteComment($commentId) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
	    $deleteComment = $commentManager->deleteComment($commentId);
	 	header('Location: index.php?action=displaySignalisedCommentsAdmin');
	}

	public function editCommentForm($commentId) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$comment = $commentManager->selectComment($commentId);
		
		require('./view/backend/adminCommentsForm.php');
	}

// ADMIN ACCOUNT
	public function adminForm($message = '') {
		require('./view/frontend/adminForm.php');
	}

	public function adminAccountModificationsForm() {
		require('./view/backend/adminAccount.php');
	}

	public function pseudoUpdate($pseudo, $password) {
		$adminManager = new \Kldr\Blog\Model\AdminManager();
		$pseudoUp = $adminManager->pseudoUpdate($pseudo, $password);
		if ($pseudoUp == true) {
			$_SESSION['pseudo'] = $pseudo;
		}
		header('Location: index.php?action=adminAccountModificationsForm');
	}

	public function passUpdate($password, $newPassword) {
		$adminManager = new \Kldr\Blog\Model\AdminManager();
		$passUp = $adminManager->passUpdate($password, $newPassword);
		if ($passUp == false) {
	    	throw new Exception('Impossible de modifier le mot de passe !');
		}
		header('Location: index.php?action=adminAccountModificationsForm&success=true');
	}
}