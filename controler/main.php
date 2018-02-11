<?php // CONTROLER - ADMIN
namespace Kldr\Blog\Controler;

// Loading classes
require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');
require_once('./model/AdminManager.php');

class MainControler
{
// PAGINATION
	public function pagination($nbPost) {
		require('./view/pagination.php');
	}

// ERROR
	public function error($message = 'Erreur') {
		$variables = array(
			'message' => $message,
		);
		$this->displayView('error', $variables); // on utilise $this pour appeler une méthode de sa propre classe
	}

// POSTS
	public function displayView($view = 'postDisplayAll', $variables = array()) {
		extract($variables); // fonction qui sert à aller chercher les variables contenu dans une variable contenant un array, et permet de les réutiliser ailleurs
		require('./view/' . $view . '.php');
		if (!empty($_SESSION['admin'])) {
			require('./view/backend/adminTemplate.php');
		} else {
			require('./view/frontend/template.php');
		}
	}

	public function displayAllPost($zone = 0) {
		$postManager = new \Kldr\Blog\Model\PostManager(); // Création d'un objet
		$nbPost = $postManager->nbPost();
		if ($nbPost > 0) {
			$posts = $postManager->getPosts($zone); // Appel d'une méthode et de son argument
			$variables = array(
				'posts' => $posts,
				'nbPost' => $nbPost,
			);
			$this->displayView('postDisplayAll', $variables);
		} else {
    		$this->error('Il n\'y a aucun billet à afficher !');
    	}
	}

		public function displayOnePost($postId, $signalised = false) {
		$postManager = new \Kldr\Blog\Model\PostManager();
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$post = $postManager->getPost($postId);
		if (!empty($post)) {
			$comments = $commentManager->getComments($postId);
			$variables = array(
				'post' => $post,
				'comments' => $comments,
				'signalised' => $signalised,
			);
			$this->displayView('postDisplayOne', $variables);
		} else {
    		$this->error('Il n\'y a aucun billet à afficher !');
		}
	}

    public function getExcerpt($string, $start = 0, $maxLength = 300) { // Affiche un extrait d'un billet et donne des valeurs par défaut qui sont modifiable lorsque on fait appel à la méthode (à cause de tinyMCE, il faut penser à prendre en compte les balises html, non visible sur le site mais considérées par le maxLength)
        if (strlen($string) > $maxLength) { // si le texte est supérieur à 100 caractères
            $string = substr($string, $start, $maxLength); // affiche le texte, depuis le premier caractère, jusqu'à 100 caractères
            $string  .= '...';
        }
        return $string;
    }

// COMMENTS
    public function addComment($postId, $author, $comment) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$success = $commentManager->postComment($postId, $author, $comment);
		if ($success != false) {
			header('Location: index.php?action=displayOnePost&id=' . $postId);
	    } else {
			$this->error('Impossible d\'ajouter le commentaire !');
	    }
	}
}