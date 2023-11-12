<?php

class User {

    private $db;
    private $staticKey;
    function __construct($dbCon) {
        $this->db = $dbCon;
        $this->staticKey = "AZBCG93b0qyJfIxfs2guaoUubKwvniR2G0FgaC9mu";
    }
    private function pwd_salt($upass) {
        $options = [
            'cost' => 12,
            'salt' => $this->staticKey,
        ];
        return $salPassword = password_hash($upass, PASSWORD_BCRYPT, $options);
    }

    public function login($femail, $upass) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE email=:email LIMIT 1");
            $stmt->execute(array(':email' => $femail));
            $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($stmt->rowCount() > 0) {
                if (password_verify($upass, $userRow['pass'])) {
                    setcookie("user", $userRow['user'], time()+3600);
                    setcookie("email", $userRow['email'], time()+3600);
                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function is_loggedin() {
        if (isset($_COOKIE['user'])) {
            return true;
        }
    }

    public function redirect($url) {
        header("Location: $url");
    }

    public function logout() {
        setcookie("user", "", time()-3600);
        setcookie("email", "", time()-3600);
        return true;
    }

}
