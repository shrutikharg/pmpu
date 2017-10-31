<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * custom_form_validation
 *
 * @package		custom_form_validations
 * @author		#shrutikharge
 * @version		1.0
 * @acepts 		$date, $format
 * @returns		TRUE / FALSE 
 * @license		MIT License Copyright (c) 2008 Erick Hartanto
 */
class MY_Form_validation extends CI_Form_validation {

    public function __construct($config = array()) {
        parent::__construct($config);
    }

    public function valid_date($date, $format = 'Y-m-d') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }

    function valid_url_format($str) {
        $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
        if (!preg_match($pattern, $str)) {
            $this->set_message('valid_url_format', 'The URL you entered is not correctly formatted.');
            return FALSE;
        }

        return TRUE;
    }

}

/* End of file My_form_validation.php */
/* Location: ./application/libraries/My_form_validation.php */