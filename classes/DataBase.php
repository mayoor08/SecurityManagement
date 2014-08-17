<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dataBase
 *
 * @author Mayoor
 */
class DataBase {
    //put your code here
    protected $host   = 'localhost';
    protected $dbname = 'securityManagement';
    protected $psw    = 'root';
    protected $user   = 'securityM';
    protected $conn;
    protected $error;
    protected $stmt;


    public function __construct() {        
        
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create New PDO instance
        try{
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname , $this->user, $this->psw,$options);
    
        }
        catch (PDOException $e){
            $this->error = $e->getMessage();
        }
    }
    
        // Query Method
    public function query($query){        
        $this->stmt = $this->conn->prepare($query); 
    }
    
        // Binding Method
    public function bindData($param, $value, $type = null){
        
        if(is_null($type)){
            switch (TRUE){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default :
                    $type = PDO::PARAM_STR;                    
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    
        // Executing Method
    public function executeSql(){
        return $this->stmt->execute();
    }
    
        // Results Set Method
    public function resultSet(){
        $this->executeSql();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function resultSet_Obj(){
        $this->executeSql();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    
        // Single Result Set Method
    public function singleSet(){
        $this->executeSql();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    
        // Row Count Method
    public function totalRowCount(){
        return $this->stmt->rowCount();
    }
}
