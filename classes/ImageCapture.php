<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImageCapture
 *
 * @author Mayoor
 */
class ImageCapture {
    //put your code here
    private $file;
    
    public function visitorPhoto($url,$vehicleNo){
        define('UPLOAD_V_DIR', 'images/visitor/');
        $imgDecode = $this->imageDecode($url);
	$success = $this->imageUpload($vehicleNo,$imgDecode);
	print $success ? $this->file : 'Unable to save the file.';
        
    }
    
    private function imageDecode($url){
        $img = str_replace('data:image/jpeg;base64,', '', $url);
	$img = str_replace(' ', '+', $img);
	return base64_decode($img);
    }
    
    private function imageUpload($vehicleNo,$imgDecode){
        $this->file = UPLOAD_V_DIR . $vehicleNo . '.jpg';
	return file_put_contents($this->file, $imgDecode);
    }
}
