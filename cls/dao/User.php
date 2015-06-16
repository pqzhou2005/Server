<?php
/**
 * User.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id: User.php 1877 2015-05-13 07:21:32Z zhoupengqian $ 
 */
namespace cls\dao;

use sys\Daoabs;
class User extends Daoabs
{

    const PRE_KEY = 'user_info_';
    
    const TOKEN_KEY = 'user_token_';
    
    private $user = array(
            'name' => '',
            'pass'=>'',
        );

    public function __construct ()
    {
        parent::__construct();
    }

    /**
     * 获取用户信息从Redis里面
     *
     * @param unknown $uid            
     */
    public function getUser ($name)
    {
        $key = $this->makeKey(self::PRE_KEY, $name);
        $ret = $this->redisHelper->hgetALl($key);
        return $ret;
    }
    
    /**
     * 
     * @param unknown $uid
     * @param unknown $info
     */
    public function setUser($name,$info)
    {
    	$key = $this->makeKey(self::PRE_KEY, $name);
    	return $this->redisHelper->hMset($key,$info);
    }
    
    /**
     * 
     * @param unknown $uid
     * @param unknown $token
     */
    public function setToken($uid,$token)
    {
    	$key = $this->makeKey(self::TOKEN_KEY, $token);
    	return $this->redisHelper->set($key,$uid);
    }
    
    /**
     * 
     * @param unknown $token
     */
    public function getToken($token)
    {
    	$key = $this->makeKey(self::TOKEN_KEY, $token);
    	return $this->redisHelper->get($token);
    }
    
    
}