<?php
    class User{

        // Connection
        private $conn;

        // Table Name
        private $db_table = "users";

        // Columns
        public $id;
        public $name;
        public $email;
        public $age;
        public $created_on;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL USERS
        public function getUsers(){
            $sqlQuery = "SELECT id, name, email, age, created_on FROM " . $this->db_table . "";
            $res = $this->conn->prepare($sqlQuery);
            $res->execute();
            return $res;
        }

        // CREATE ALL USERS
        public function createUser(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        email = :email, 
                        age = :age, 
                        created_on = :created_on";
        
            $res = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->created_on=htmlspecialchars(strip_tags($this->created_on));
        
            // bind data
            $res->bindParam(":name", $this->name);
            $res->bindParam(":email", $this->email);
            $res->bindParam(":age", $this->age);
            $res->bindParam(":created_on", $this->created_on);
        
            if($res->execute()){
               return true;
            }
            return false;
        }
    }

?>

