<?php
/**
 * Daoabs.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id: Daoabs.php 152 2015-02-26 05:59:15Z zhoupengqian $ 
 */
namespace sys;
abstract class Daoabs {
	
	protected $redisHelper;
	
	protected function __construct()
	{
	    $conf = array('host'=>\Sys\Config::getInstance()->redis_host,'port'=>\Sys\Config::getInstance()->redis_port);
	    $this->redisHelper = RedisHelper::getInstance()->conn($conf);
	}

	protected function makeKey($postfix,$uid=null)
	{
	    if($uid){
	    	return $postfix.$uid;
	    }
		return $postfix;
	}
	
	
	/**
	 * 检查数据的完备性
	 * @param unknown $compactData
	 * @param unknown $sourceData
	 * @return multitype:unknown
	 */
	protected function checkCompact($compactData,$sourceData)
    {
        $data = array();
        foreach($compactData as $k=>$v){
            $data[$k] = isset($sourceData[$k])?$sourceData[$k]:$v;
        }
        return $data;
    }
}
