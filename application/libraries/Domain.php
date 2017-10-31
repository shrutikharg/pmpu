<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Domain
 *
 * @author a
 */
class Domain {
    private $CI;
private $root_domain_path='/frontend/paper_lantern/subdomain/doadddomain.html?rootdomain=shri.coolacharya.com';
    private $root_domain = 'coolacharya';
    private $public_html_dir = '&dir=public_html/companyadminapp1';
    private $and_domain = '&domain=';
    private $localhost = 'coolacharya.com';
    private $cpanel_port = '2082';
    private $cpanel_user = 'coolaffw';
    private $cpanel_password = 'Mats87#Cool@';
    private $socket_port = '128';

    public function __construct() {
        
    }

    public function create_subdomain($subDomain) {
        $buildRequest = $this->root_domain_path ;

        $openSocket = fsockopen($this->localhost,$this->cpanel_port);
        if (!$openSocket) {
            return FALSE;
        }

        $authString = $this->cpanel_user . ":" . $this->cpanel_password;
        $authPass = base64_encode($authString);
        $buildHeaders = "GET " . $buildRequest . "\r\n";
        $buildHeaders .= "HTTP/1.0\r\n";
        $buildHeaders .= "Host:coolacharya.com\r\n";
        $buildHeaders .= "Authorization: Basic " . $authPass . "\r\n";
        $buildHeaders .= "\r\n";

        fputs($openSocket, $buildHeaders);
        while (!feof($openSocket)) {
            $result = fgets($openSocket, $this->socket_port);
   
        
        }
        fclose($openSocket);
return "http://" . $subDomain . "." . $this->root_domain . "/admin_company/login";
        
    }
    public function get_company_byDomain(){
        $this->CI = & get_instance();
      // $current_url= base_url(uri_string());
        $current_url= 'pmipune.coolacharya.com';
       $parsedUrl = parse_url($current_url);

$host = explode('.', $current_url);

$subdomain = $host[0];
$this->CI->load->model('company_model');
$company_data=$this->CI->company_model->get_company_byDomain($subdomain);
  
   return $company_data;     
    }


 function get_company_cms_bydomain(){
  $this->CI = & get_instance();
      // $current_url= base_url(uri_string());
        $current_url= 'pmipune.coolacharya.com';
       $parsedUrl = parse_url($current_url);

$host = explode('.', $current_url);

$subdomain = $host[0];
$this->CI->load->model('company_model');
$company_data=$this->CI->company_model->get_company_cms_bydomain($subdomain);
  
   return $company_data;   
}
}