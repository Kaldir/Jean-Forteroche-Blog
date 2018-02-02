<?php // CONTROLER - ADMIN
namespace Kldr\Blog\Controler;

// Loading classes
require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');
require_once('./model/AdminManager.php');

class BackendControler
{

// POSTS
	public function adminIndex() {
		require('./view/backend/adminIndex.php');
	}

	public function adminPosts() {
		require('./view/backend/adminPosts.php');
	}

	public function adminViewPosts($zone) {
		$postManager = new \Kldr\Blog\Model\PostManager(); // Création d'un objet
		$posts = $postManager->getPosts($zone); // Appel d'une fonction de cet objet
		$nbPost = $postManager->nbPost();

		require('./view/backend/adminPosts.php');
	}

	public function displayPostForm($postId) {
		$postManager = new \Kldr\Blog\Model\PostManager();
	    $post = $postManager->getPost($postId);
		require('./view/backend/postModify.php');
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
				header('Location: index.php?action=adminViewPosts');
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

// COMMENTS
	public function adminComments() {
		require('./view/backend/adminComments.php');
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

// ADMIN ACCOUNT
	public function adminForm($message = '') {
		require('./view/frontend/admin.php');
	}

	public function adminAccountModifications() {
		require('./view/backend/adminAccount.php');
	}

	public function pseudoUpdate($pseudo, $password) {
		$adminManager = new \Kldr\Blog\Model\AdminManager();
		$pseudoUp = $adminManager->pseudoUpdate($pseudo, $password);
		if ($pseudoUp == true) {
			$_SESSION['pseudo'] = $pseudo;
		}
		header('Location: index.php?action=adminAccountModifications');
	}

	public function passUpdate($password, $newPassword) {
		$adminManager = new \Kldr\Blog\Model\AdminManager();
		$passUp = $adminManager->passUpdate($password, $newPassword);
		if ($passUp == false) {
	    	throw new Exception('Impossible de modifier le mot de passe !');
		}
		header('Location: index.php?action=adminAccountModifications&success=true');
	}
}