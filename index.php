<?php // ROUTEUR
require('controler/frontend.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        listPosts();
    }

    elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            post();
        } else {             
            throw new Exception('Aucun identifiant de billet envoyé'); // gestion des erreurs avec une exception : stop l'exécution, envoie l'exception, va directement au bloc catch
        }

    } elseif ($_GET['action'] == 'addComment') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                addComment($_GET['id'], $_POST['author'], $_POST['comment']);
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }

    } elseif ($_GET['action'] == 'displayCommentsForm') {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            displayCommentsForm();
        } else {
            throw new Exception('Aucun identifiant de billet envoyé');
        }
    }
    
} else {
    listPosts();
}