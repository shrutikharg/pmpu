<?php
@session_start();
class Session
{
    var $SessionName='Default';
   
    /* Function name: Constructor
    Params:
        @SessionName - The session name
    */
    function __constructor($SessionName)
    {
        $this->SessionName=$SessionName;
    }
    /* Function name: Set
    Params:
        @Setting - The key to set
        @Value - The value to set
    */
    function Set($Setting,$Value)
    {
        $_SESSION[$this->SessionName][$Setting]=$Value;
    }
    /* Function name: Get
    Params:
        @Setting - The key to get
        @Default - Value to return if the requested key is empty.
    */
    function Get($Setting,$Default='')
    {
        if(isset($_SESSION[$this->SessionName][$Setting]) && !empty($_SESSION[$this->SessionName][$Setting]))
            return $_SESSION[$this->SessionName][$Setting];
        else
            return $Default;
    }
	
	function Remove($Setting)
    {
        if(isset($_SESSION[$this->SessionName][$Setting]) && !empty($_SESSION[$this->SessionName][$Setting]))
		 unset($_SESSION[$this->SessionName][$Setting]);
    }
   
}
?>