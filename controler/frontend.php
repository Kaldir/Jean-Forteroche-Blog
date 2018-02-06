<?php // CONTROLER
namespace Kldr\Blog\Controler;

require_once('./controler/main.php');

class FrontendControler extends MainControler
{
// POSTS
	public function listPosts($zone = 0) {
		$postManager = new \Kldr\Blog\Model\PostManager(); // Création d'un objet
		$posts = $postManager->getPosts($zone); // Appel d'une méthode et de son argument
		$nbPost = $postManager->nbPost();

		require('./view/frontend/postDisplayAll.php');
	}

	public function displayOnePostUser($postId, $signalised = false) {
		$postManager = new \Kldr\Blog\Model\PostManager();
		$commentManager = new \Kldr\Blog\Model\CommentManager();

		$post = $postManager->getPost($postId);
		$comments = $commentManager->getComments($postId);

		require('./view/frontend/postDisplayOne.php');
	}

// COMMENTS
	public function addComment($postId, $author, $comment) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();

		$success = $commentManager->postComment($postId, $author, $comment);

		if ($success == false) {
	        throw new Exception('Impossible d\'ajouter le commentaire !'); // message d'erreur, erreur qui remonte jusqu'au bloc try du routeur (function $dbconnect -> model.php)
	    } else {
			header('Location: index.php?action=displayOnePostUser&id=' . $postId);
	    }
	}

	public function signal($commentId, $postId) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$commentManager->signalisedComment($commentId);
		header('Location: index.php?action=displayOnePostUser&signaled=true&id=' . $postId);
	}

// ADMIN ACCOUNT
	public function checkLogin($password, $email) {
		$adminManager = new \Kldr\Blog\Model\AdminManager();
		$result = $adminManager->checkLogin($_POST['password'], $_POST['email']);
        if ($result['status'] == 'ok') {
            $_SESSION['admin'] = true;
            $_SESSION['pseudo'] = $result['data']['pseudo']; // va chercher l'info pseudo contenu dans le tableau data contenu dans la variable result lorsque status = ok
            $_SESSION['email'] = $result['data']['email'];
        	header('Location: index.php?action=adminIndex');
        } else {
    		$this->error($result['data']); // va chercher le message d'erreur contenu dans data lorsque status = error (voir AdminManager.php)
        }
	}	
}