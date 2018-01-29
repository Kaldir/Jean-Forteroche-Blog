<?php
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
        $frontendControler->listPosts($zone);
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
    
    } elseif ($_GET['action'] == 'editForm') {
        if (isset($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['comment']) && !empty($_POST['id_post'])) {
            $backendControler->modifyComment($_GET['id'], $_POST['comment'], $_POST['id_post']);
        } else {             
            throw new Exception('Erreur');
        }

    } elseif ($_GET['action'] == 'displayCommentsForm') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $frontendControler->displayCommentsForm($_GET['id']);
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }

    } elseif ($_GET['action'] == 'login') {
        if (isset($_POST['password']) AND $_POST['password'] == "Alaska" AND isset($_POST['pseudo']) AND $_POST['pseudo'] == "Forteroche") {
        $backendControler->adminIndex();
        } else {
       $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
        }

    } elseif ($_GET['action'] == 'addPost') {
            if (!empty($_POST['title']) && !empty($_POST['content'])) {
                $backendControler->addPost($_POST['title'], $_POST['content']);
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
        }

    } elseif ($_GET['action'] == 'displayPostForm') {
        $backendControler->displayPostForm($_GET['id']);

    } elseif ($_GET['action'] == 'editPost') {
        if (isset($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['title']) && !empty($_POST['content'])) {
            $backendControler->editPost($_POST['title'], $_POST['content'], $_GET['id']);
        } else {             
            throw new Exception('Erreur');
        }

    } elseif ($_GET['action'] == 'deletePost') {
        $backendControler->deletePost($_GET['id']);

    } elseif ($_GET['action'] == 'adminLogin') {
        $backendControler->adminForm();
    
    } elseif ($_GET['action'] == 'adminViewPosts') {
        if (!isset($_GET['page']) || $_GET['page'] < 0) { // Si la variable page n'est pas définie
        $page = 1;
        } else {
            $page = htmlspecialchars($_GET['page']); // Sinon lecture de la page
        }
        $zone = 5 * ($page - 1); // Calcul du facteur multiplicateur pour determinez la zone
        $backendControler->adminViewPosts($zone);

    } elseif ($_GET['action'] == 'adminViewComments') {
        $backendControler->adminComments();

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