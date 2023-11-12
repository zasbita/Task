<?php

class Crud {

    private $db;
    function __construct($dbCon) {
        $this->db = $dbCon;
    }
    public function get_all_data($query) {
        $stmt = $this->db->prepare($query); 
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function create($fname, $femail, $fphone) {
        try {
            $stmt = $this->db->prepare("INSERT INTO users(name,email,phone) VALUES(:name, :email, :phone)");
            $stmt->bindparam(":name", $fname);
            $stmt->bindparam(":email", $femail);
            $stmt->bindparam(":phone", $fphone);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function read($id = null) {
        if ($id) {
            $stmt = $this->db->prepare("SELECT * FROM users WHERE id=:id");
            $stmt->execute(array(":id" => $id));
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return FALSE;
            }
        } else {
            
        }
    }

    public function update($id, $fname, $femail, $fphone) {
        try {
            $stmt = $this->db->prepare("UPDATE users SET 
                name=:name, 
                email=:email, 
                phone=:phone
             WHERE id=:id");
            $stmt->bindparam(":name", $fname);
            $stmt->bindparam(":email", $femail);
            $stmt->bindparam(":phone", $fphone);
            $stmt->bindparam(":id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    
    public function delete($id) {
        if ($id) {
            $stmt = $this->db->prepare("DELETE FROM users WHERE id=:id");
            $stmt->bindparam(":id", $id);
            $stmt->execute();
            return true;
        }
    }

}
