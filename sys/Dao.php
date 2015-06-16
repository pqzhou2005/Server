<?php
/**
 * Dao.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id: Dao.php 1263 2015-04-13 11:47:02Z zhoupengqian $ 
 */
namespace sys;
class Dao {
	private $data;
	private static $instance;

	public function __construct(){}

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


	/**
	 * 定义魔术函数__call，用以实现getXxxDao()方法的调用，以更直接的方式取得一个Dao实例
	 *
	 * @param 方法名 $name
	 * @param 方法参数 $arguments
	 * @return object
	 */
	public function __call($name, $arguments)
	{
		$posOfGet = strpos($name,'get');
		if ($posOfGet !== 0) {
			throw new \Exception('there is no method name of [' . $name . ']');
		}
		$className = substr($name,3);
		if (substr($className,- 3) != 'Dao') {
			throw new \Exception('there is no method name of [' . $name . ']');
		}
		$className = substr($className,0,strlen($className) - 3);
		return $this->getDao(strtolower($className));
	}


	/**
	 * 创建具体的dao类
	 *
	 * @param string $daoName 要创建的dao类名称
	 * @return object 具体的dao对象
	 */
	public function getDao($daoName,$params=array())
	{
	    $keyName = $daoName;
	    if(!empty($params['_prefix']))
	    {
	        $keyName = $daoName.$params['_prefix'];
	    }
	     
	    if (isset($this->data [$keyName]))
	        return $this->data [$keyName];
	    	
	    // new one object
		$clsname = '\cls\dao\\' . $daoName;
		$object = new $clsname($params);
		$this->data [$keyName] = $object;
		return $object;
	}

}

