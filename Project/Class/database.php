<?php
class Database {
    private $con;
    //construct
    function __construct()
    {
        $this->con=$this->connect();
    }
    // connect to db
    private function connect()
    { $string="mysql:host=localhost;dbname=mychat_db";
        try{
            $connection= new PDO($string, DBUSER,DBPASS);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $connection;
        }catch(PDOException $e)
        {
            echo $e->getMessage();
            die;
        }
        return false;
        
    }

    //read from db
    public function read($query, $data_array = [])
    {
        $statement = $this->con->prepare($query);
        
        // Debugging: Print the query and data_array to check their consistency
        // echo "Query: $query<br>";
        //echo "Data Array: " . print_r($data_array, true) . "<br>";
    
        // Bind parameters explicitly
        if (!empty($data_array)) {
            foreach ($data_array as $key => $value) {
                // Bind each parameter correctly
                $statement->bindValue(":$key", $value);
            }
        }
    
        // Execute the query
        $check = $statement->execute();
    
        if ($check) {
            $result = $statement->fetchAll(PDO::FETCH_OBJ);
            return (is_array($result) && count($result) > 0) ? $result : false;
        }
        return false;
    }
    


    
    public function generate_id($max)
    {
        $rand="";
        $rand_count=rand(4,$max);
        for ($i=0; $i < $rand_count; $i++) { 
            # code...
            $r= rand(0,9);
            $rand.=$r;
        }
        return $rand;

    }
}


?>