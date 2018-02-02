<?php
session_start();
require('controler/frontend.php');
require('controler/backend.php');

$frontendControler = new \Kldr\Blog\Controler\FrontendControler();
$backendControler = new \Kldr\Blog\Controler\BackendControler();

// GESTION DE LA PAGINATION
if (!isset($_GET['page']) || $_GET['page'] < 0) { // Si la variable page n'est pas définie
    $page = 1;
} else {
    $page = htmlspecialchars($_GET['page']); // Sinon lecture de la page
}
$zone = 5 * ($page - 1); // Calcul du facteur multiplicateur pour determinez la zone

// GESTION DES ACTIONS
if (!empty($_GET['action'])) {
    if (empty($_SESSION['admin'])) { // vérifie si une session admin existe ou non (en l'occurence, non), et permet donc uniquement l'exécution des actions front suivantes :

    // FRONT POSTS     
        if ($_GET['action'] == 'post') {
            if (!empty($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_GET['signaled'])) {
                    $frontendControler->post($_GET['id'], true); // si signaled existe, sa valeur est true
                } else {
                    $frontendControler->post($_GET['id']); // sinon, elle garde sa valeur par défaut (false)
                }
            } else {             
                throw new Exception('Aucun identifiant de billet envoyé'); // gestion des erreurs avec une exception : stop l'exécution, envoie l'exception, va directement au bloc catch
            }

    // FRONT COMMENTS
        } elseif ($_GET['action'] == 'displayCommentsForm') {
            if (!empty($_GET['id']) && $_GET['id'] > 0) {
                $frontendControler->displayCommentsForm($_GET['id']);
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        } elseif ($_GET['action'] == 'addComment') {
            if (!empty($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    $frontendControler->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }

        } elseif ($_GET['action'] == 'signalComment') {
            if (!empty($_GET['id']) && $_GET['id'] > 0) {
                $frontendControler->signal($_GET['id'], $_GET['postId']);
            }

    // FRONT ADMIN ACCOUNT
        } elseif ($_GET['action'] == 'adminLogin') {
            $backendControler->adminForm();

        } elseif ($_GET['action'] == 'login') {
            if (!empty($_POST['password']) AND isset($_POST['email'])) {
                $frontendControler->checkLogin($_POST['password'], $_POST['email']);
            } else {
                $backendControler->adminForm('Votre identifiant ou votre mot de passe est incorrect !');
            }
        }

    } else { // Sinon, si une session existe, les actions  back qui suivent peuvent s'exécuter :

    // BACK POSTS
        if ($_GET['action'] == 'adminViewPosts') {
            $backendControler->adminViewPosts($zone);

        } elseif ($_GET['action'] == 'displayPostForm') {
            $backendControler->displayPostForm($_GET['id']);

        } elseif ($_GET['action'] == 'addPost') {
            $backendControler->addPost($_POST['title'], $_POST['content']);

        } elseif ($_GET['action'] == 'editPost') {
            if (!empty($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['title']) && !empty($_POST['content'])) {
                $backendControler->editPost($_POST['title'], $_POST['content'], $_GET['id']);
            } else {             
                throw new Exception('Erreur');
            }

        } elseif ($_GET['action'] == 'deletePost') {
            $backendControler->deletePost($_GET['id']);

    // BACK COMMENTS
        } elseif ($_GET['action'] == 'adminViewComments') {
            $backendControler->adminComments();

        } elseif ($_GET['action'] == 'editForm') {
                if (!empty($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['comment']) && !empty($_POST['id_post']) && $_POST['id_post'] > 0) {
                $backendControler->modifyComment($_GET['id'], $_POST['comment'], $_POST['id_post']);
            } else {             
                throw new Exception('Erreur dans la saisie du formulaire');
            }

    // BACK ADMIN ACCOUNT
        } elseif ($_GET['action'] == 'adminIndex') {
            $backendControler->adminIndex();

        } elseif ($_GET['action'] == 'adminAccountModifications') {
            $backendControler->adminAccountModifications();

        } elseif ($_GET['action'] == 'pseudoUpdate') {
                if  (!empty($_POST['newPseudo']) && !empty($_POST['password'])) {
                    $backendControler->pseudoUpdate($_POST['newPseudo'], $_POST['password']);
                } 

        } elseif ($_GET['action'] == 'passUpdate') {
                if  (!empty($_POST['password']) && !empty($_POST['newPassword']) && !empty($_POST['checkPassword']) && $_POST['newPassword'] == $_POST['checkPassword']) {
                    $backendControler->passUpdate($_POST['password'], $_POST['newPassword']);
                }

        } elseif ($_GET['action'] == 'logout') {
            session_destroy();
            $frontendControler->listPosts();
        }
    }
} else {
    $frontendControler->listPosts($zone);
}