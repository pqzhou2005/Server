<?php 
/**
 * RedisHelper.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id: RedisHelper.php 13 2015-02-02 06:27:31Z zhoupengqian $ 
 */
namespace sys;
class RedisHelper
{
    private $redis;
    
    private static $connects = array();
    
    private static $instance;
    
	public function __construct()
	{
        $this->redis = new \Redis();   
	}
	/**
	 * 
	 */
	public static function getInstance()
	{
		if (! self::$instance) {
			$className = __CLASS__;
			self::$instance = new $className();
		}
		
		return self::$instance;
	}
	
	public function conn($conf)
	{
	     $key = md5($conf['host'].$conf['port']);
	     if(isset(self::$connects[$key])){
	     	return $this;
	     }
	     
	     $ret = $this->redis->connect($conf['host'],$conf['port']);
	     if($ret){
    	     self::$connects[$key] = $ret;
	     }else{
	         Log::getInstance()->log('redis/error', array('connect fail',$conf['host'],$conf['port']))->write();
	     }
	     return $this;
	}
	
	public function __call($method, $args)
	{
	    Log::getInstance()->log('redis/query', array($method,json_encode($args)))->write();
		return call_user_func_array( array( $this->redis , $method ) , $args );
	}
}
?>