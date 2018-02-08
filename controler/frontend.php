<?php // CONTROLER
namespace Kldr\Blog\Controler;

require_once('./controler/main.php');

class FrontendControler extends MainControler
{
// POSTS
	public function listPosts($zone = 0) {
		$postManager = new \Kldr\Blog\Model\PostManager(); // Création d'un objet
		$nbPost = $postManager->nbPost();
		if ($nbPost > 0) {
			$posts = $postManager->getPosts($zone); // Appel d'une méthode et de son argument
			require('./view/frontend/postDisplayAll.php');
		} else {
    		$this->error('Il n\'y a aucun billet à afficher !');
    	}
	}

	public function displayOnePostUser($postId, $signalised = false) {
		$postManager = new \Kldr\Blog\Model\PostManager();
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$post = $postManager->getPost($postId);
		if (!empty($post)) {
			$comments = $commentManager->getComments($postId);
			require('./view/frontend/postDisplayOne.php');
		} else {
    		$this->error('Il n\'y a aucun billet à afficher !');
		}
	}

// COMMENTS
	public function addComment($postId, $author, $comment) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$success = $commentManager->postComment($postId, $author, $comment);
		if ($success != false) {
			header('Location: index.php?action=displayOnePostUser&id=' . $postId);
	    } else {
			$this->error('Impossible d\'ajouter le commentaire !');
	    }
	}

	public function signal($commentId, $postId) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$signal = $commentManager->signalComment($commentId);
		if ($signal > 0) {
			header('Location: index.php?action=displayOnePostUser&signaled=true&id=' . $postId);
		} else {
    		$this->error('Ce message a déjà été signalé et va être modéré prochainement, merci !');
		}
	}

// ADMIN ACCOUNT
	public function checkLogin($password, $email) {
		$adminManager = new \Kldr\Blog\Model\AdminManager();
		$adminInfo = $adminManager->checkLogin($_POST['password'], $_POST['email']);
        if (is_array($adminInfo)) {
            $_SESSION['admin'] = true;
            $_SESSION['pseudo'] = $adminInfo['pseudo']; // va chercher l'info pseudo contenu dans le tableau data contenu dans la variable adminInfo lorsque status = ok
            $_SESSION['email'] = $adminInfo['email'];
        	header('Location: index.php?action=adminIndex');
        } else {
    		$this->error('Votre pseudo ou votre mot de passe est incorrect !');
        }
	}
}