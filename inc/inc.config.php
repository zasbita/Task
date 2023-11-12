<?php
namespace MyConfig;

include_once 'inc.class.user.php';
include_once 'inc.class.crud.php';
use userLogin\User;
use userLogin\Crud;
use PDO;
use PDOException;

class Config {
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPass = "";
    private $dbName = "db_task";
    public $con;
    public $crud;
    public $user;

    public function __construct()
    {
        try {
            $this->con = new PDO("mysql:host={$this->dbHost};dbname={$this->dbName}", $this->dbUser, $this->dbPass);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->crud = new Crud($this->con);
            $this->user = new User($this->con);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
