<?php
namespace userLogin;
include 'upload.php';

use PDO;
use MyUpload\ImageUploader;

class Crud {

    private $db;
    function __construct($dbCon) {
        $this->db = $dbCon;
    }

    private function sanitizeInput($input) {
        return strip_tags(trim($input));
    }

    public function get_all_data($query) {
        $stmt = $this->db->prepare($query); 
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        }
    }

    public function create($name, $image, $date, $session) {
        $session = $this->sanitizeInput($session);
        if ($_COOKIE['user'] !== $session) {
            echo "<script>alert('Token salah'); document.location='index.php';</script>";
            return false;
        }

        $imageUploader = new ImageUploader();
        $name = $this->sanitizeInput($name);

        $path = '';
        if (isset($image)) {
            $uploadedFile = $image;
            $path = $imageUploader->uploadImage($uploadedFile);
        }

        try {
            $stmt = $this->db->prepare("INSERT INTO tasks (name, image, create_dtm) VALUES (?, ?, ?)");
            if ($stmt->execute([$name, $path, $date])) {
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Gagal mengeksekusi kueri'); document.location='task_add.php';</script>";
                return false;
            }
        } catch (\Throwable $e) {
            echo "<script>alert(".$e->getMessage()."); document.location='task_add.php';</script>";
            return false;
        }
    }

    public function update($id, $name, $image, $session) {
        $session = $this->sanitizeInput($session);
        if ($_COOKIE['user'] !== $session) {
            echo "<script>alert('Token salah'); document.location='index.php';</script>";
            return false;
        }

        $imageUploader = new ImageUploader();
        $name = $this->sanitizeInput($name);

        $path = '';
        if (isset($image)) {
            $uploadedFile = $image;
            $path = $imageUploader->uploadImage($uploadedFile);
        }

        try {
            $stmt = $this->db->prepare("UPDATE tasks SET name=?, image=? WHERE task_id=?");
            if ($stmt->execute([$name, $path, $id])) {
                header("Location: index.php");
                exit();
            } else {
                echo "<script>alert('Gagal mengeksekusi kueri'); document.location='task_edit.php';</script>";
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            echo "<script>alert(".$e->getMessage()."); document.location='task_edit.php';</script>";
            return false;
        }
    }
    
    public function delete($id) {
        try {
            if ($id) {
                $stmt = $this->db->prepare("DELETE FROM tasks WHERE task_id=?");
                if ($stmt->execute([$id])) {
                    header("Location: index.php");
                    exit();
                } else {
                    echo "<script>alert('Gagal mengeksekusi kueri'); document.location='task_delete.php';</script>";
                    return false;
                }
            }
        } catch (\Throwable $e) {
            echo "<script>alert(".$e->getMessage()."); document.location='task_delete.php';</script>";
            return false;
        }
    }

    public function read($id = null) {
        if ($id) {
            $stmt = $this->db->prepare("SELECT * FROM tasks WHERE task_id=?");
            $stmt->execute([$id]);
            /* if result execute not empty */
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return FALSE;
            }
        } else {
            
        }
    }

}
