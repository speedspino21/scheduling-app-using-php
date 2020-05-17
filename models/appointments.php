<?php 
require_once('initialization.php');

class Appointment {
    private $conn;
    private $table_name = 'appointments';

    // Users properties 
    public $id;
    public $name;
    public $email;
    public $date;
    public $timeslots;

    //db connect
    public function __construct(){
        global $database;
        $this->conn = $database->connect();
    }
    //get user by id
    public function find_appointment_by_id($id=0)
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE id = :id LIMIT 1";
        
        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute(array('id'=>$id))){
            $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
            // Set properties
            return $appointment;
        }else{
            return false;
        }
    }

    public function find_all()
    {
        $query = "SELECT * FROM ".$this->table_name." ORDER BY id DESC";

         //Prepare statement 
         $stmt = $this->conn->prepare($query);

         // Execute query
         if($stmt->execute()){
             return $stmt;
         }else{
             return false;
         }
    }

    public function find_date_month_year($month, $year)
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE MONTH(date) = '{$month}' AND YEAR(date) = '{$year}' ";

        //Prepare statement 
        $stmt = $this->conn->prepare($query);

        // Execute query
        if($stmt->execute()){
            return $stmt;
        }else{
            return false;
        }

    }

    public function find_appointment_by_date()
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE date = :date LIMIT 1";

        // prepare query 
        $stmt = $this->conn->prepare($query);

        // clear data
        $this->date = htmlentities($this->date);

        // bind Date
        $stmt->bindParam('date', $this->date);

        if($stmt->execute()){
            $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
            return $appointment;
        }
    }

    public function find_appointment_by_date_and_timeslots()
    {
        $query = "SELECT * FROM ".$this->table_name." ";
        $query .= "WHERE date = :date AND timeslots = :timeslots LIMIT 1";

        // prepare query 
        $stmt = $this->conn->prepare($query);

        // clear data
        $this->date = htmlentities($this->date);
        $this->timeslots = htmlentities($this->timeslots);


        // bind Date
        $stmt->bindParam('date', $this->date);
        $stmt->bindParam('timeslots', $this->timeslots);

        if($stmt->execute()){
            $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
            return $appointment;
        }
    }

    public function save(){
        $query = "";
        if(empty($this->id)){
            $query .= "INSERT INTO ".$this->table_name."("; 
            $query .= "name, email, date, timeslots"; 
            $query .= ")VALUES("; 
            $query .= ":name, :email, :date, :timeslots"; 
            $query .= ")";
        }else{
            $query = "UPDATE ".$this->table_name." SET ";
            $query .= "name=:name, email=:email, date=:date, timeslots=:timeslots "; 
            $query .= "WHERE id = :id";
        }
        //propare statement 
        $stmt = $this->conn->prepare($query);

        //clean data
        if(!empty($this->id)){
            $this->id = htmlentities($this->id);
        }
        $this->name = htmlentities($this->name);
        $this->email = htmlentities($this->email);
        $this->date = htmlentities($this->date);
        $this->timeslots = htmlentities($this->timeslots);

        //Bind Data
        if(!empty($this->id)){
            $stmt->bindParam(':id', $this->id);
        }
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':timeslots', $this->timeslots);

        //Execute Query 
        if($stmt->execute()){
            if(empty($this->id)){
                $this->id = $this->conn->lastInsertId();
            }
            return true;
        } 
    }
    
}