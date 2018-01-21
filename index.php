<?php // ROUTEUR
require('controler/frontend.php');
require('controler/backend.php');

$frontendControler = new \Kldr\Blog\Controler\FrontendControler();
$backendControler = new \Kldr\Blog\Controler\BackendControler();

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        $frontendControler->listPosts();
    }

    elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            $frontendControler->post();
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
            $frontendControler->displayCommentsForm();
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }

    } elseif ($_GET['action'] == 'adminLogin') {
        $backendControler->adminForm();
    }
    
} else {
    $frontendControler->listPosts();
}