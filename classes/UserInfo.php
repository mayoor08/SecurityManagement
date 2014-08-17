<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserInfo
 *
 * @author Mayoor
 */
require_once 'DataBase.php';
class UserInfo {

    public function registerUser ($name, $vModel, $vRegno, $vType, $house){
        
        $db = new DataBase();
        $db->query('insert into userinfo set u_vehicle_model = :vModel,'
                    . 'u_vehicle_regno = :vRegno,'
                    . 'u_vehicle_type = :vType,'
                    . 'u_name = :uName,'
                    . 'u_house_no = :house');
        
        $db->bindData(':vModel', $vModel);
        $db->bindData(':vRegno', $vRegno);
        $db->bindData(':vType', $vType);
        $db->bindData(':uName', $name);
        $db->bindData(':house', $house);
        $db->executeSql();
    }
    
    public function deleteUser ($vRegno){
        //code for deleting user
         $db = new DataBase();
        $db->query('delete from userinfo where u_vehicle_regno = :vRegno');
        $db->bindData(':vRegno', $vRegno);
        $db->executeSql();
    }
    
    public function searchRegisteredVehicle ($sVehicleRegNo) {
        $db = new DataBase();
        $db->query('select * from userinfo where u_vehicle_regno = :vRegno');
        $db->bindData(':vRegno', $sVehicleRegNo);
        return $db->resultSet();
    }
    
    public function changeVehicleStatusToIn ($sVehicleRegNo) {
        $db = new DataBase();
        $db->query('insert into res_in set res_vehicle_reg = :vRegno, res_in_status = "IN"');
        $db->bindData(':vRegno', $sVehicleRegNo);
        return $db->executeSql();    
    }
    
     public function changeVehicleStatusToOut ($sVehicleRegNo) {
        $db = new DataBase();
        $db->query('insert into res_out set res_vehicle_reg = :vRegno, res_out_status = "OUT"');
        $db->bindData(':vRegno', $sVehicleRegNo);
        return $db->executeSql();    
    }
    public function updateUser (){
        //code for update user
    }
}
 