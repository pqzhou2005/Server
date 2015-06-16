<?php
/**
 * Serviceabs.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id: Serviceabs.php 202 2015-02-28 06:44:36Z zhoupengqian $ 
 */
namespace sys;
use sys;
abstract class Serviceabs {
	
    public $errorNo;
    
    public $errorMsg;
    
    protected $daoLocator;
    
	protected $serviceLocator;

	protected $server;
	
	public function __construct()
	{
		$this->daoLocator = Dao::getInstance();
		$this->serviceLocator = Service::getInstance();
	    $this->server = \cls\socket\WebSocket::getInstance();
	}
}