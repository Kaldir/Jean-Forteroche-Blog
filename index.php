<?php
session_start();
require('autoloader/autoloader.php'); // chargement de l'autoloader
Autoloader::register();

$frontendControler = new \Kldr\Blog\Controler\FrontendControler();
$backendControler = new \Kldr\Blog\Controler\BackendControler();

if (!isset($_GET['page']) || $_GET['page'] < 0) { // Si la variable page n'est pas définie
    $page = 1;
} else {
    $page = htmlspecialchars($_GET['page']); // Sinon lecture de la page
}
$zone = 5 * ($page - 1); // Calcul du facteur multiplicateur pour determinez la zone

// GESTION DES ACTIONS
if (!empty($_GET['action'])) {
    if ($_GET['action'] == 'displayOnePost') {
        if (!empty($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_GET['signaled'])) {
                $frontendControler->displayOnePost($_GET['id'], true); // si signaled existe, sa valeur est true
            } else {
                $frontendControler->displayOnePost($_GET['id']); // sinon, elle garde sa valeur par défaut (false)
            }
        } else {
            $frontendControler->error('L\'identifiant du billet n\'existe pas...');
        }
    
    } elseif ($_GET['action'] == 'addComment') {
        if (!empty($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                $frontendControler->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            } else {
                $frontendControler->error('Tous les champs ne sont pas remplis !');
            }
        } else {
            $frontendControler->error('L\'identifiant du billet n\'existe pas...');
        }

    } elseif (empty($_SESSION['admin'])) { // vérifie si une session admin existe ou non (en l'occurence, non), et permet donc uniquement l'exécution des actions front suivantes : 

    // FRONT COMMENTS
        if ($_GET['action'] == 'signalComment') {
            if (!empty($_GET['id']) && $_GET['id'] > 0) {
                $frontendControler->signal($_GET['id'], $_GET['postId']);
            } else {
                $frontendControler->error('L\'identifiant du billet n\'existe pas...');
            }            

    // FRONT ADMIN ACCOUNT
        } elseif ($_GET['action'] == 'loginForm') {
            $frontendControler->adminForm();

        } elseif ($_GET['action'] == 'login') {
            if (!empty($_POST['password']) AND !empty($_POST['email'])) {
                $frontendControler->checkLogin($_POST['password'], $_POST['email']);
            } else {
                $frontendControler->error('Tous les champs ne sont pas remplis !');
            }

    // ERROR (if a non-admin action is executed with empty_$SESSION['admin'])
        } else {
            $frontendControler->displayAllPost($zone);
        }

    } else { // Sinon, si une session existe, les actions back qui suivent peuvent s'exécuter :

    // BACK POSTS
        if ($_GET['action'] == 'editPostForm') {
            $backendControler->editPostForm($_GET['id']);

        } elseif ($_GET['action'] == 'displayOnePostAdmin') {
            $backendControler->displayAllPost($_GET['id']);

        } elseif ($_GET['action'] == 'addPost') {
            $backendControler->addPost($_POST['title'], $_POST['content']);

        } elseif ($_GET['action'] == 'editPost') {
            if (!empty($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['title']) && !empty($_POST['content'])) {
                $backendControler->editPost($_POST['title'], $_POST['content'], $_GET['id']);
            } else {
                $backendControler->error('L\'identifiant du billet n\'existe pas et/ou tous les champs ne sont pas remplis.');
            }

        } elseif ($_GET['action'] == 'deletePost') {
            $backendControler->deletePost($_GET['id']);

    // BACK COMMENTS
        } elseif ($_GET['action'] == 'displaySignalisedCommentsAdmin') {
            $backendControler->adminComments();

        } elseif ($_GET['action'] == 'editCommentForm') {
            if (!empty($_GET['id']) && $_GET['id'] > 0) {
                $backendControler->editCommentForm($_GET['id']);
            } else {
                $backendControler->error('L\'identifiant du billet n\'existe pas...');
            }

        } elseif ($_GET['action'] == 'editComment') {
            if (!empty($_POST['id']) && $_POST['id'] > 0 && !empty($_POST['comment']) && !empty($_POST['id_post']) && $_POST['id_post'] > 0) {
                $backendControler->editComment($_POST['id'], $_POST['comment'], $_POST['id_post']);
            } else {
                $backendControler->error('Tous les champs ne sont pas remplis !');
            }

        } elseif ($_GET['action'] == 'deleteComment') {
            $backendControler->deleteComment($_GET['id']);

    // BACK ADMIN ACCOUNT
        } elseif ($_GET['action'] == 'adminIndex') {
            $backendControler->adminIndex();

        } elseif ($_GET['action'] == 'adminAccountModificationsForm') {
            $backendControler->adminAccountModificationsForm();

        } elseif ($_GET['action'] == 'pseudoUpdate') {
            if  (!empty($_POST['newPseudo']) && !empty($_POST['password'])) {
                $backendControler->pseudoUpdate($_POST['newPseudo'], $_POST['password']);
            } else {
                $backendControler->error('Tous les champs ne sont pas remplis !');
            }

        } elseif ($_GET['action'] == 'passUpdate') {
            if  (!empty($_POST['password']) && !empty($_POST['newPassword']) && !empty($_POST['checkPassword'])) {
                $backendControler->passUpdate($_POST['password'], $_POST['newPassword']);
            } else {
                $backendControler->error('Tous les champs ne sont pas remplis !');
            }

        } elseif ($_GET['action'] == 'logout') {
            $backendControler->logout();
        } else {
            $frontendControler->displayAllPost($zone);
        }
    }
} else {
$frontendControler->displayAllPost($zone); // on ne met pas de else, ainsi cette méthode est exécutée dans tous les cas
}