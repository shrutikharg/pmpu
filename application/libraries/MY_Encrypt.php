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
class MY_Encrypt extends CI_Encrypt {

    public $CI;

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function encrypt_password($string) {
        $encrypted_password = $this->encode($string);
        return $encrypted_password;
    }

    public function decrypt_password($encrypted_string) {
        return $this->decode($encrypted_string);
    }

    public function create_password() {
        $password = '';
        $keys = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
        for ($i = 0; $i < 8; $i++) {
            $password .= $keys[array_rand($keys)];
        }
        return array('encrypted_password'=> $this->encode($password),'original_password'=>$password);
    }

}
