<?php
/**
 * Yphp.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id$ 
 */
namespace sys;

class Config
{
    private static $instance = null;
    
	/**
	 * 构造函数
	 * 
	 */
	public function __construct() {}
	
	public static function getInstance()
	{
	    if (! self::$instance) {
	        $className = __CLASS__;
	        self::$instance = new $className();
	    }
	
	    return self::$instance;
	}
	
	public function init($string)
	{
	    $arr = explode("\n", $string);
	    
        foreach($arr as $v)
        {
            if(substr($v, 0, 1)!='#' && strpos($v,'=')!==false)
            {
            	$str = explode('=', $v);
            	$property_name = trim($str[0]);
            	$property_value = trim($str[1]);
                $this->$property_name = $property_value;
//                 echo "$property_name=$property_value\n";
            } 		
        }
	}
}

