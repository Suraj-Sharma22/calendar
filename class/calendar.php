<?php
    class Calendar{

        // Connection
        private $conn;

        // Table Name
        private $db_table = "calendar";

        // Columns
        public $id;
        public $joinersId;
        public $title;
        public $duration;
        public $start_date;
        public $end_date;
        public $created_by;
        public $created_on;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL MEETINGS
        public function getMeetings(){
            $sqlQuery = "SELECT calendar.id, calendar.title, calendar.duration, users.name 
            FROM calendar 
            JOIN users ON calendar.joinersId = users.id";
            $res = $this->conn->prepare($sqlQuery);
            $res->execute();
            return $res;
        }

        // CREATE MEETINGS
        public function createMeetings(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        joinersId = :joinersId, 
                        title = :title, 
                        duration = :duration, 
                        start_date = :start_date, 
                        end_date = :end_date, 
                        created_by = :created_by,
                        created_on = :created_on";
        
            $res = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->joinersId=htmlspecialchars(strip_tags($this->joinersId));
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->duration=htmlspecialchars(strip_tags($this->duration));
            $this->start_date=htmlspecialchars(strip_tags($this->start_date));
            $this->end_date=htmlspecialchars(strip_tags($this->end_date));
            $this->created_by=htmlspecialchars(strip_tags($this->created_by));
            $this->created_on=htmlspecialchars(strip_tags($this->created_on));
        
            // bind data
            $res->bindParam(":joinersId", $this->joinersId);
            $res->bindParam(":title", $this->title);
            $res->bindParam(":duration", $this->duration);
            $res->bindParam(":start_date", $this->start_date);
            $res->bindParam(":end_date", $this->end_date);
            $res->bindParam(":created_by", $this->created_by);
            $res->bindParam(":created_on", $this->created_on);
        
            if($res->execute()){
               return true;
            }
            return false;
        }

        // CHECK USER  AVAILABILITY
        public function checkAvailaibilty($start_date, $end_date){
             $sqlQuery = "SELECT
                        *
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       start_date >= '". $start_date. "' AND end_date <= '".$end_date."'";

            $res = $this->conn->prepare($sqlQuery);
            $res->execute();
            return $res;
           
        }        

    }

?>

