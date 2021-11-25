<?php
/*
    * PDO database class
    * Connect to database
    * Create prepared statements
    * Bind values
    * Return rows and results
*/

class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbh; // database handler
    private $stmt; // for prepared statements
    private $error;

    public function __construct(){
        // Create connection string to database:


        // Set DSN (TypeOfDatabase:host=HostName;dbname=DatabaseName)
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT=>true, // Persistent connection
            PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION // Errors handler
        );

        // Create PDO instance
        try {
            $this->dbh = new PDO($dsn,$this->user,$this->pass,$options);
        } catch (PDOException $err) {
            $this->error = $err->getMessage();
            echo $this->error;
        }
    }

    // Prepared statement to database with a query
    public function query($sql){
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Bind values
    public function bind($params, $value, $type=null){
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;


                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($params,$value,$type);
    }

    // Execute the prepared statement to database
    public function execute(){
        return $this->stmt->execute();
    }

    // Get the records as objects array
    public function resultArray(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Get single record as object
    public function singleResult(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // Get the records count
    public function recordsCount(){
        return $this->stmt->rowCount();
    }



}



?>