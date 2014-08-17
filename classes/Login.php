<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login
 *
 * @author Mayoor
 */

require_once 'DataBase.php';

class Login {
    //put your code here
    private $instance;

    public function loginStatus ($username,$password){
        
        $salt = $this->saltFetch($username);
        $hashed_password = $this->hashedPassword($password,$salt);
        $row_count = $this->checkPassword($hashed_password);
        if($row_count == 1)
		{
                    session_start();                   
		    $result = $this->instance;
		    $userType = $result->user_type_id;
                 // $_SESSION['last_active']=time();
                    $_SESSION['name'] = $result->name;
                    return json_encode($userType);
		}
		else
		{ //echo 'no record';
                    return json_encode($row_count);
		}
        
    }
    
    private function saltFetch($username){
        $db = new DataBase();
        $db->query('SELECT salt FROM login WHERE username=:username');        
        $db->bindData(':username', $username);
        $db->executeSql();
        $result = $db->resultSet_Obj();
        if($result){
            return $result->salt;
        }
        else{
            return FALSE;            
        }
    }    
    
    private function hashedPassword($password,$salt){
        $config['global_salt']='$2a$05$';
        $config['local_salt']='$';
        $bcrypt_salt = $config['global_salt'].$salt.$config['local_salt'];
        $hashed_password = crypt($password,$bcrypt_salt);
        return $hashed_password;      
    }
    
    private function checkPassword($hashPassword){
        $db = new DataBase();
        $db->query('Select * from login WHERE password = :password');
        $db->bindData(':password', $hashPassword);
        $db->executeSql();        
        $this->instance = $db->resultSet_Obj();      
        return $db->totalRowCount();
    }
}
