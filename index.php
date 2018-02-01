<?php
session_start();
require('controler/frontend.php');
require('controler/backend.php');

$frontendControler = new \Kldr\Blog\Controler\FrontendControler();
$backendControler = new \Kldr\Blog\Controler\BackendControler();

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        if (!isset($_GET['page']) || $_GET['page'] < 0) { // Si la variable page n'est pas définie
            $page = 1;
        } else {
            $page = htmlspecialchars($_GET['page']); // Sinon lecture de la page
        }
        $zone = 5 * ($page - 1); // Calcul du facteur multiplicateur pour determinez la zone
        $frontendControler->listPosts();
    }

    elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (isset($_GET['signaled'])) {
                $frontendControler->post($_GET['id'], true); // si signaled existe, sa valeur est true
            } else {
                $frontendControler->post($_GET['id']); // sinon, elle garde sa valeur par défaut (false)
            }
        } else {             
            throw new Exception('Aucun identifiant de billet envoyé'); // gestion des erreurs avec une exception : stop l'exécution, envoie l'exception, va directement au bloc catch
        }

// ADMIN ACCOUNT
    } elseif ($_GET['action'] == 'adminLogin') {
        $backendControler->adminForm();

    } elseif ($_GET['action'] == 'login') {
        if (isset($_POST['password']) AND isset($_POST['email'])) {
            $frontendControler->checkLogin($_POST['password'], $_POST['email']);
        } else {
            $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
        }

    } elseif ($_GET['action'] == 'adminIndex') {
        if ($_SESSION['admin'] == true) {
            $backendControler->adminIndex();
        } else {
            $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
        }

    } elseif ($_GET['action'] == 'adminAccountModifications') {
        if ($_SESSION['admin'] == true) {
        $backendControler->adminAccountModifications();
        } else {
        $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
        }

    } elseif ($_GET['action'] == 'pseudoUpdate') {
        if ($_SESSION['admin'] == true) {
            if  (!empty($_POST['newPseudo']) && !empty($_POST['password'])) {
                $backendControler->pseudoUpdate($_POST['newPseudo'], $_POST['password']);
            } 
        } else {
        $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
        }
/*
    } elseif ($_GET['action'] == 'passUpdate') {
        if ($_SESSION['admin'] == true) {
            if  (!empty($_POST['password']) && !empty($_POST['newPassword']) && !empty($_POST['checkPassword'])) {
                $backendControler->passUpdate($_POST['password'], $_POST['newPassword'], $_POST['checkPassword']);
            }
        } else {
        $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
        }
*/
    } elseif ($_GET['action'] == 'logout') {
        session_destroy();
        $frontendControler->listPosts();

// POSTS
    } elseif ($_GET['action'] == 'adminViewPosts') {
        if ($_SESSION['admin'] == true) {
            if (!isset($_GET['page']) || $_GET['page'] < 0) { // Si la variable page n'est pas définie
            $page = 1;
            } else {
                $page = htmlspecialchars($_GET['page']); // Sinon lecture de la page
            }
            $zone = 5 * ($page - 1); // Calcul du facteur multiplicateur pour determinez la zone
            $backendControler->adminViewPosts($zone);
        } else {
        $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
        }

    } elseif ($_GET['action'] == 'displayPostForm') {
        if ($_SESSION['admin'] == true) {
            $backendControler->displayPostForm($_GET['id']);
        } else {
        $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
        }

    } elseif ($_GET['action'] == 'addPost') {

    } elseif ($_GET['action'] == 'editPost') {
        if ($_SESSION['admin'] == true) {
            if (isset($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['title']) && !empty($_POST['content'])) {
                $backendControler->editPost($_POST['title'], $_POST['content'], $_GET['id']);
            } else {             
                throw new Exception('Erreur');
            }
        } else {
        $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
        }

    } elseif ($_GET['action'] == 'deletePost') {
        if ($_SESSION['admin'] == true) {
            $backendControler->deletePost($_GET['id']);
        } else {
        $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
        }

// COMMENTS
    } elseif ($_GET['action'] == 'displayCommentsForm') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $frontendControler->displayCommentsForm($_GET['id']);
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }

    } elseif ($_GET['action'] == 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                $frontendControler->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }

    } elseif ($_GET['action'] == 'adminViewComments') {
        if ($_SESSION['admin'] == true) {
            $backendControler->adminComments();
        } else {
        $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
        }

    } elseif ($_GET['action'] == 'editForm') {
        if ($_SESSION['admin'] == true) {
                if (isset($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['comment']) && !empty($_POST['id_post'])) {
                $backendControler->modifyComment($_GET['id'], $_POST['comment'], $_POST['id_post']);
            } else {             
                throw new Exception('Erreur');
            }
        } else {
        $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
        }

    } elseif ($_GET['action'] == 'signalComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $frontendControler->signal($_GET['id'], $_GET['postId']);
        }
    }

} else {
    if (!isset($_GET['page']) || $_GET['page'] < 0) { // Si la variable page n'est pas définie
        $page = 1;
    } else {
        $page = htmlspecialchars($_GET['page']); // Sinon lecture de la page
    }
    $zone = 5 * ($page - 1); // Calcul du facteur multiplicateur pour determinez la zone
    $frontendControler->listPosts($zone);
}