<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MY_Encryption
 *
 * @author a
 */
class MY_Encrypt extends CI_Encrypt{
    public $CI;
    

    public function __construct() {
        $this->CI = & get_instance();
       
    }
    public function encrypt_password($string){
     $encrypted_password= $this->encode($string);
return $encrypted_password;
   
     
    }
     public function decrypt_password($encrypted_string){
      return   $this->decode($encrypted_string);
    }
}
