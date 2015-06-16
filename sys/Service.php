<?php
/**
 * Service.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id: Service.php 866 2015-03-23 10:05:11Z zhoupengqian $ 
 */
namespace sys;
class Service {
	private $data;
	private static $instance;


	public function __construct()
	{
	}


	public static function getInstance()
	{
		if (! self::$instance) {
			$className = __CLASS__;
			self::$instance = new $className();
		}
		
		return self::$instance;
	}


	/**
	 * 定义魔术函数__call，用以实现getXxxService()方法的调用，以更直接的方式取得一个Service实例
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
		if (substr($className,- 7) != 'Service') {
			throw new \Exception('there is no method name of [' . $name . ']');
		}
		$className = substr($className,0,strlen($className) - 7);
		return $this->getService(strtolower($className));
	}


	/**
	 * 创建具体的service类
	 *
	 * @param string $serviceName 要创建的service类名称
	 * @return object 具体的service对象
	 */
	public function getService($serviceName, $params=array())
	{
		// read from cache
		$keyName = $serviceName;
		if(!empty($params['_prefix']))
		{
		    $keyName = $serviceName.$params['_prefix'];
		}
	    
		if (isset($this->data [$keyName]))
			return $this->data [$keyName];
			
		// new one object
		$clsname = 'cls\service\\' . $serviceName;
		$object = new $clsname($params);
		$this->data [$keyName] = $object;
		return $object;
	}

}

