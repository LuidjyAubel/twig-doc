<?php
namespace App\Classes\Manager;

use PDO;
use App\Classes\Entity\User;

class UserManager
{
    private $_db;

    public function __construct(PDO $db)
    {
        $this->setDb($db);
    }

    public function setDb($db): UserManager
    {
        $this->_db = $db;
        return $this;
    }

    public function addUser($email, $password)
    {
        // Netoyge des donnés envoyées
        // $email = strip_tags($_POST['email']);
        // $password = strip_tags($_POST['password']);

        $stmt = $this->_db->prepare("INSERT INTO users (email, `password`) VALUE (?, ?);");
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $password);

        // Appel de la procédure stockée
        $stmt->execute();
    }

    public function delete(User $user) //:bool
    {
        $requete = $this->_db->query('SELECT id, email FROM users');
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)){
            if ($user == $ligne['id']){
                $stmt = $this->_db->prepare('DELETE FROM users WHERE id = ?;');
                $stmt->bindParam(1,$user);
                $stmt->execute();
                print("L'utilisateur à étais supprimer avec succès !<br>");
                print("<a class='btn btn-primary' href='dashbord.php'>dashbord</a><br>");
            }
    }
    }
    public function update(User $user) //:bool

    {
        // A re-travailler
        $requete = $this->_db->query('SELECT id, email, `password` FROM users;');
        while ($ligne = $requete->fetch(PDO::FETCH_ASSOC)){
            if ($id == $ligne['id']){
                print("<form method='POST'>");
                print("<label for='modifie'>Id : </label>");
                print("<input type='text' name='modifie' value=".$ligne['id']."><br><br>");
                print("<label for='modif'>EMAIL : </label>");
                print("<input type='text' name='modif' value=".$ligne['EMAIL']."><br><br>");
                print("<input type='submit' value='Valider'>");
                print("</form>");
                $stmt = $this->_db->prepare('UPDATE usern SET EMAIL = ? WHERE id = ?;');
                $stmt->bindParam(2, $_POST['modifie']);
                $stmt->bindParam(1,$_POST['modif']);
                $stmt->execute();
            }
               }
    }

    public function connectUser($email, $password)
    {
        session_start();
        $_SESSION["connecter"] = FALSE;
        $request = $this->_db->query('SELECT id, email, `password` FROM users');
        while ($ligne = $request->fetch(PDO::FETCH_ASSOC)){ 
            if ($email == $ligne['email']){
               $hash = $ligne['password'];
               if (password_verify($password, $hash)) {
                   echo 'Le mot de passe est valide !';
                   $_SESSION['connecter'] = TRUE;
                } else {
                   session_destroy();
                   echo '<div class="error">Le mot de passe est invalide.</div>';
                }
            }
        }
    }

    public function getList(): array
    {
        $userList = array();

        $request = $this->_db->query('SELECT id, email FROM users;');
        while ($ligne = $request->fetch(PDO::FETCH_ASSOC)) {
            $user = new User($ligne);
            $userList[] = $user;
        }
        return $userList;
    }
}
 
 
?>