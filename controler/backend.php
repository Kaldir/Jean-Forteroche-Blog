<?php // CONTROLER - ADMIN
namespace Kldr\Blog\Controler;

require_once('./controler/main.php');

class BackendControler extends MainControler
{

// POSTS
	public function adminIndex() {
		$this->displayView('backend/adminIndex'); // on utilise $this pour appeler une méthode de sa propre classe
	}

	public function displayOnePostAdmin($postId) {
		$postManager = new \Kldr\Blog\Model\PostManager();
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$post = $postManager->getPost($postId);
		$comments = $commentManager->getComments($postId);
		if (!empty($post)) {
			$variables = array(
				'post' => $post,
				'comments' => $comments,				
			);
			$this->displayView('postDisplayOne', $variables);
		} else {
			$this->error('Il n\'y a aucun billet à afficher !');
		}
	}

	public function editPostForm($postId) {
		$postManager = new \Kldr\Blog\Model\PostManager();
	    $post = $postManager->getPost($postId);
	    if (!empty($post)) {
			$variables = array(
				'post' => $post,
			);
			$this->displayView('backend/adminPostModifyForm', $variables);
		} else {
			$this->error('Impossible d\'éditer le billet !');
	    }
	}

	public function addPost($title, $content) {
		$postManager = new \Kldr\Blog\Model\PostManager();
		$success = $postManager->postPost($title, $content);
		if ($success > 0) {
			header('Location: index.php'); 
	    } else {
			$this->error('Impossible d\'ajouter le billet !');
	    }
	}

	public function editPost($title, $content, $postId) {
		$postManager = new \Kldr\Blog\Model\PostManager();
		$success = $postManager->editPost($title, $content, $postId);
		if ($success > 0) {
			header('Location: index.php');
		} else {
			$this->error('Impossible d\'éditer le billet !');
		}		    	
	}

	public function deletePost($postId) {
		$postManager = new \Kldr\Blog\Model\PostManager();
	    $deletePost = $postManager->deletePost($postId);
	 	if ($deletePost > 0) {
	 		header('Location: index.php'); // renvoie l'admin sur la page admin des posts
		} else {
			$this->error('Aucun billet n\'a été effacé...');
		}
	}

// COMMENTS
	public function adminComments() {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$comments = $commentManager->getCommentsSignalised();
		if (!empty($comments)) {
			$variables = array(
				'comments' => $comments,
			);
			$this->displayView('backend/adminComments', $variables);			
		} else {
			$this->error('Il n\'y a aucun commentaire à modérer !');
		}
	}

	public function editComment($commentId, $comment) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
	    $editComment = $commentManager->editComment($commentId, $comment);
	    if ($editComment > 0) {
	        header('Location: index.php?action=displaySignalisedCommentsAdmin');
		} else {
			$this->error('Impossible d\'éditer le commentaire...');
		}
	}

	public function deleteComment($commentId) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
	    $deleteComment = $commentManager->deleteComment($commentId);
	    if ($deleteComment > 0) {
	 	header('Location: index.php?action=displaySignalisedCommentsAdmin'); // renvoie l'admin sur la page des commentaires signalés après la suppression de l'un d'eux
		} else {
			$this->error('Aucun commentaire n\'a été effacé...');
		}
	}

	public function editCommentForm($commentId) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$comment = $commentManager->selectComment($commentId);
		if (!empty($comment)) {
			$variables = array(
				'comment' => $comment,
			);
			$this->displayView('backend/adminCommentsForm', $variables);
	    } else {
			$this->error('Ce commentaire n\'existe pas !');
	    }
	}

// ADMIN ACCOUNT
	public function adminAccountModificationsForm() {
		$this->displayView('backend/adminAccount');
	}

	public function pseudoUpdate($pseudo, $password) {
		$adminManager = new \Kldr\Blog\Model\AdminManager();
		$pseudoUp = $adminManager->pseudoUpdate($pseudo, $password);
		if ($pseudoUp > 0) { // rapport au rowCount, on vérifie si une ligne a été modifiée (voir AdminManager.php méthode pseudoUpdate)
			$_SESSION['pseudo'] = $pseudo;
			header('Location: index.php?action=adminAccountModificationsForm');
	    } else {
			$this->error('Impossible de modifier le pseudo !');
	    }
	}

	public function passUpdate($password, $newPassword) {
		$adminManager = new \Kldr\Blog\Model\AdminManager();
		$passUp = $adminManager->passUpdate($password, $newPassword);
		if ($passUp > 0 && $_POST['newPassword'] == $_POST['checkPassword']) {
			header('Location: index.php?action=adminAccountModificationsForm&success=true');
	    } else {
			$this->error('Impossible de modifier le mot de passe !');
	    }
	}

	public function logout() {
	    session_destroy();
		header('Location: index.php');
	}

}