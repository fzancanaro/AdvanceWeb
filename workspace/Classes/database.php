<?php
//this class uses parameterised query to mitigate
//SQL injection attacks. Instead of accepting a string as a query
//including its parameters, it accepts a query string containing ? in
//place of the parameters
//eg "SELECT * FROM accounts WHERE account_id = ?"
//Then (a)  parameter is passed to the database to replace the question mark
class Database{
  private $connection;
  private $output = array();
  private $params = array();
  
  //database credentials and details
  private $user = "website";
  private $password = "password";
  private $host ="localhost";
  private $db = "datastore";
  
  //--__construct is called when class is initialised
  //--eg when new Database() is called
  public function __construct(){
    try{
      $this->connection = mysqli_connect($host,$user,$password,$db);
    }
    catch(Exception $exc){
      //log the exception to system error log
      error_log($exc,0);
    }
  }
  public function runQuery($query){
    $this->params = $params;
    //check if query is select, insert or update
    if(strpos($query,"SELECT") === 0){
      $result = $this->connection->query($query);
      if($result->num_rows > 0){
        //if there are results return result as an array
        while($row = $result->fetch_assoc()){
          array_push($this->output,$row);
        }
        return $this->output;
      }
      else{
        //if there are no results return false
        return false;
      }
    }
  }
}
?>