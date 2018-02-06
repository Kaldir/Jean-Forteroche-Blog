<?php // CONTROLER - ADMIN
namespace Kldr\Blog\Controler;

// Loading classes
require_once('./model/PostManager.php');
require_once('./model/CommentManager.php');
require_once('./model/AdminManager.php');

class MainControler
{
	public function error($message = 'Erreur') {
		require('./view/error.php');
	}
}