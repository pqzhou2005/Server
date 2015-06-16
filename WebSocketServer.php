<?php
/**
 * Server.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id$ 
 */
define('ROOT_PATH',__DIR__);

include ROOT_PATH.'/sys/Yphp.php';
\sys\Yphp::bootstrap();

$string = file_get_contents(ROOT_PATH.'/include/webSocketServer.conf');
\sys\Config::getInstance()->init($string);

\cls\socket\WebSocket::getInstance()->start();