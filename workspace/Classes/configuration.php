<?php
// this class imports data for database
// and site configuration
//located in the /configuration folder
class Configuration{
  private $dbconfiguration = array();
  private $siteconfiguration = array();
  private $errors = array();
  
  //configuration files location
  private $dbConfigFile = "configuration/dbconfiguration.json.php";
  private $siteConfigFile = "configuration/siteconfiguration.json.php";
  
  public function __construct(){
    //check if configuration file exists and readable
    if( !is_readable($dbConfigFile) ){
      $this->errors["database"] = "no database configuration found";
    }
    if( !is_readable($siteConfigFile) ){
      $this->errors["site"] = "no site configuration found";
    }
    //if no errors read the config files
    if( count($this->errors)==0 ){
      $this->readConfigurations();
    }
    else{
      return false;
    }
  }
  
  private function readConfigurations(){
    include_once($this->dbConfigFile);
    $dbconfig = json_decode($dbconfiguration,true);
    
    include_once($this->siteConfigFile);
    $siteconfig = json_decode($siteconfiguration,true);
    
    return (object) [$dbconfig,$siteconfig];
  }
  
  public getErrors(){
    return $this->errors;
  }
}
?>