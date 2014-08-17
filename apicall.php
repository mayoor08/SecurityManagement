<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$data = $_POST["uData"];
switch ($data['apiCall']){
    case "UserRegistration":
        require_once 'classes/UserInfo.php';
        $name   = filter_var($data['name'],FILTER_SANITIZE_STRING);
        $vModel = filter_var($data['vModel'],FILTER_SANITIZE_STRING);
        $vRegno = filter_var($data['vRegno'],FILTER_SANITIZE_STRING);
        $vType  = filter_var($data['vType'],FILTER_SANITIZE_STRING);
        $house  = filter_var($data['house'],FILTER_SANITIZE_STRING);
        $usr = new UserInfo();
        $usr->registerUser($name, $vModel, $vRegno, $vType, $house);
        break;
        
    case "DeleteUser":
        require_once 'classes/UserInfo.php';
        $vRegno = filter_var($data['d-vRegno'],FILTER_SANITIZE_STRING);
        $usr = new UserInfo();
        $usr->deleteUser($vRegno);  
        break;
        
    case "SearchVehicle":
        require_once 'classes/UserInfo.php';
        $vRegno = filter_var($data['s-vRegno'],FILTER_SANITIZE_STRING);
        $usr = new UserInfo();
        $result =  $usr->searchRegisteredVehicle($vRegno);
        print_r(json_encode($result));
        break;
    
     case "ChangeInStatus":
        require_once 'classes/UserInfo.php';
        $vRegno = filter_var($data['s-vRegno'],FILTER_SANITIZE_STRING);
        $usr = new UserInfo();
        $res= $usr->changeVehicleStatusToIn($vRegno);
        echo $res;
        break;

    case "ChangeOutStatus":
        require_once 'classes/UserInfo.php';
        $vRegno = filter_var($data['s-vRegno'],FILTER_SANITIZE_STRING);
        $usr = new UserInfo();
        $res= $usr->changeVehicleStatusToOut($vRegno);
        echo $res;
        break;
    
    
    case "LoginStatus":
        require_once 'classes/Login.php';
        $username = filter_var($data['loginUser'],FILTER_SANITIZE_STRING);
        $password = filter_var($data['pass'],FILTER_SANITIZE_STRING);        
        $login = new Login();
        $res = $login->loginStatus($username, $password);
        echo $res;
        break;
    
    
    case "ClickVisitorPhoto":
        require_once 'classes/ImageCapture.php';
        $url = filter_var($data['url'],FILTER_SANITIZE_STRING);
        $vehicleNo = filter_var($data['veh'],FILTER_SANITIZE_STRING);
        $capture = new ImageCapture();
        $capture->visitorPhoto($url, $vehicleNo);
        break;
}