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
    private $root_domain_path ;
    private $root_domain = 'coolacharya';
    private $public_html_dir = '&dir=public_html/companyadminapp1';
    private $and_domain = '&domain=';
    private $localhost = 'coolacharya.com';
    private $cpanel_port = '2082';
    private $cpanel_user = 'coolaffw';
    private $cpanel_password = 'Mats87#Cool@';
    private $socket_port = '128';
    private $emailArray;
    private $cpsess = '1414692128';
    private $logcurl;
    public $cookiefile;
    public function __construct() {
        $this->logcurl = false;
         $this->cookiefile ="../cpmm/cpmm_cookie_".rand(99999, 9999999).".txt";
        $this->LogIn();
    }

    public function create_subdomain($subDomain) {
        $this->root_domain_path = '/frontend/paper_lantern/subdomain/doadddomain.html?rootdomain=coolacharya.com&domain='.$subDomain.'&dir=public_html/pmipune&go=Create';
      
        $buildRequest = $this->root_domain_path;

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
        return "http://" . $subDomain . "." . $this->root_domain;
    }

    public function get_company_byDomain() {
        $this->CI = & get_instance();
        // $current_url= base_url(uri_string());
        $current_url = 'PMIPUNE.coolacharya.com';
        $parsedUrl = parse_url($current_url);

        $host = explode('.', $current_url);

        $subdomain = $host[0];
        $this->CI->load->model('company_model');
        $company_data = $this->CI->company_model->get_company_byDomain($subdomain);

        return $company_data;
    }

    function get_company_cms_bydomain() {
        $this->CI = & get_instance();
        // $current_url= base_url(uri_string());
        $current_url = 'pmipune.coolacharya.com';
        $parsedUrl = parse_url($current_url);

        $host = explode('.', $current_url);

        $subdomain = $host[0];
        $this->CI->load->model('company_model');
        $company_data = $this->CI->company_model->get_company_cms_bydomain($subdomain);

        return $company_data;
    }

    function check_domain_availability($domain_name) {
        $params = 'user=' . $this->cpanel_user . '&pass=' . $this->cpanel_password;
        ;
        $url = "http://" . $this->localhost . ":" . $this->cpanel_port . $this->cpsess . "/json-api/cpanel?cpanel_jsonapi_user=" . $this->cpanel_user .
                "?cpanel_jsonapi_version=2" .
                "&cpanel_jsonapi_func=listsubdomains" .
                "&cpanel_jsonapi_module=SubDomain&regex=" . $domain_name;
        $answer = $this->request($url, $params);

        $emails = json_decode($answer, true);
       
      //  echo $emails['cpanelresult']['preevent']['result'];
        $this->emailArray = $emails["cpanelresult"]["data"];
        return $this->emailArray;
    }

    function request($url, $params = array()) {
        if ($this->logcurl) {
            $curl_log = fopen($this->curlfile, 'a+');
        }
        
        if (!file_exists($this->cookiefile)) {
            @fopen($this->cookiefile, "w");
            if (!file_exists($this->cookiefile)) {
                echo 'Cookie file missing. ' . $this->cookiefile;
                exit;
            }
        } else if (!is_writable($this->cookiefile)) {
            echo 'Cookie file not writable. ' . $this->cookiefile;
            exit;
        }
        $ch = curl_init();
        $curlOpts = array(
            CURLOPT_URL => trim($url),
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:29.0) Gecko/20100101 Firefox/29.0',
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_COOKIEJAR => realpath($this->cookiefile),
            CURLOPT_COOKIEFILE => realpath($this->cookiefile),
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_PORT => 2082,
            CURLOPT_HTTPHEADER => array(
                "Host: " . $this->localhost,
                "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
                "Accept-Language: en-US,en;q=0.5",
                "Accept-Encoding: gzip, deflate",
                "Connection: keep-alive",
                "Content-Type: application/x-www-form-urlencoded")
        );

        if (!empty($params)) {
            $curlOpts[CURLOPT_POST] = true;
            $curlOpts[CURLOPT_POSTFIELDS] = $params;
        }
        if ($this->logcurl) {
            $curlOpts[CURLOPT_STDERR] = $curl_log;
            $curlOpts[CURLOPT_FAILONERROR] = false;
            $curlOpts[CURLOPT_VERBOSE] = true;
        }
        curl_setopt_array($ch, $curlOpts);
        $answer = curl_exec($ch);
        if (curl_error($ch)) {
           // echo curl_error($ch);
            exit;
        }
        curl_close($ch);
        if ($this->logcurl) {
            fclose($curl_log);
        }
        return (@gzdecode($answer)) ? gzdecode($answer) : $answer;
    }
        public function logCurl($curlfile = "cpmm/cpmm_curl_log.txt"){
        if(!file_exists($curlfile)){
            try{
                fopen($curlfile, "w");
            }catch(Exception $ex){
                if(!file_exists($curlfile)){
                    return $ex.'Cookie file missing.'; exit;
                }
                return true;
            }
        }else if(!is_writable($curlfile)){
            return 'Cookie file not writable.'; exit;
        }
        $this->logcurl = true;
        return true;
    }
    private function LogIn(){
        $url = 'http://'.$this->localhost.":".$this->cpanel_port."/login/?login_only=1";
        $url .= "&user=".$this->cpanel_user."&pass=".urlencode($this->cpanel_password);
        $answer = $this->Request($url);
        $answer = json_decode($answer, true);
        if(isset($answer['status']) && $answer['status'] == 1){
            $this->cpsess = $answer['security_token'];
            $this->homepage = 'https://'.$this->localhost.":".$this->cpanel_port.$answer['redirect'];
        }
    }

}