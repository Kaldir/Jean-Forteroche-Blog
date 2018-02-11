<?php // CONTROLER
namespace Kldr\Blog\Controler;

require_once('./controler/main.php');

class FrontendControler extends MainControler
{
// COMMENTS
	public function signal($commentId, $postId) {
		$commentManager = new \Kldr\Blog\Model\CommentManager();
		$signal = $commentManager->signalComment($commentId);
		if ($signal > 0) {
			header('Location: index.php?action=displayOnePost&signaled=true&id=' . $postId);
		} else {
    		$this->error('Ce message a déjà été signalé et va être modéré prochainement, merci !');
		}
	}

// ADMIN ACCOUNT
	public function adminForm() {
		$this->displayView('frontend/adminForm'); // on utilise $this pour appeler une méthode de sa propre classe
	}

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