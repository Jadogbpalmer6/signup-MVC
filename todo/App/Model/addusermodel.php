<?php
class addusermodel extends model
{

    public function __construct()
    {
        $this->connect();
    }

    public function EmailExist($email)
    {

        try {
            $query = $this->DB->prepare("SELECT COUNT(*) AS NUMBER_OF_EMAILS FROM users WHERE email=?");
            $query->execute(array($email));
            $num = $query->fetchall(PDO::FETCH_ASSOC);
            return $num[0]['NUMBER_OF_EMAILS'];
        } catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }
    }
    public function UsernameExist($username)
    {
        try {
            $query = $this->DB->prepare("SELECT COUNT(*) AS NUMBER_OF_USERNAME FROM users WHERE username=?");
            $query->execute(array($username));
            $num = $query->fetchall(PDO::FETCH_ASSOC);
            return ($num[0]['NUMBER_OF_USERNAME']);

        } catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }

    }
    public function adduser($userinfo)
    {
        try {
            $query = $this->DB->prepare("INSERT INTO users(username,email,password) VALUES(?,?,?)");
            $query->execute($userinfo);
            return 1;
        } catch (PDOException $th) {
            $error = array('ERROR' => $th->getMessage());
            echo json_encode($error);
            die();
        }

    }

}
