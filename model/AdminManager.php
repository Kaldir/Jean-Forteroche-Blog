<?php // Model
namespace Kldr\Blog\Model;

require_once("Manager.php");

class AdminManager extends Manager
{
    public function checkLogin($password, $email) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT pseudo, password, email FROM admin WHERE email = ?');
        $req->execute(array($email));
        $admin = $req->fetch();
        if (password_verify($password, $admin['password'])) {
            $adminInfo = [
                'pseudo' => $admin['pseudo'],
                'email' => $admin['email'],
            ];
            return $adminInfo;
        }
        return false;
    }

    public function pseudoUpdate($pseudo, $password) { // pour gérer les modifs d'id du compte admin
        $db = $this->dbConnect();
        $checkLogin = $this->checkLogin($password, $_SESSION['email']);
        if (is_array($checkLogin)) {
            $req = $db->prepare('UPDATE admin SET pseudo = ? WHERE email = ?');
            $pseudoUp = $req->execute(array($pseudo, $_SESSION['email']));
            return $pseudoUp;
        }
        return false;
    }

        public function passUpdate($password, $newPassword) { // pour gérer les modifs de mdp du compte admin
        $db = $this->dbConnect();
        $checkLogin = $this->checkLogin($password, $_SESSION['email']);
        if (is_array($checkLogin)) {
            $newPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Hachage du mot de passe
            $req = $db->prepare('UPDATE admin SET password = ? WHERE email = ?');
            $passUp = $req->execute(array($newPassword, $_SESSION['email']));
            return $passUp;
        }
    return false;
    }
}