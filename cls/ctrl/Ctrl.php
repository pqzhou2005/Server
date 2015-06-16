<?php
/**
 * Server.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id$ 
 */
namespace cls\ctrl;

use cls\socket\WebSocket;
class Ctrl
{
    private $server;
    
    private $fd;
    
    private $requestData;
    
    public function __construct ($fd,$data)
    {
    	$this->server = WebSocket::getInstance();
        $this->fd = $fd;
        $this->requestData = $data;
    }

    public function start()
    {
        //$obj = array('ctrl' => 'Control','cmd' => 'moveBall');
        
        $obj = array('ctrl'=>'Control','cmd'=>'iniBall','ball'=>array('x'=>300,'y'=>270));
        $this->server->send($this->fd, $obj);
        
        $playerList = array();
        
        for($i=0;$i<11;$i++)
        {
            $x = mt_rand(200, 800);
            $y = mt_rand(170, 570);
            $number = mt_rand(1, 100);
            $playerList[] = array('type'=>'red','number'=>$number,'x'=>$x,'y'=>$y);
        }
        
        for($i=0;$i<11;$i++)
        {
            $x = mt_rand(200, 800);
            $y = mt_rand(170, 570);
            $number = mt_rand(1, 100);
        	$playerList[] = array('type'=>'green','number'=>$number,'x'=>$x,'y'=>$y);
        }
        
        $obj = array('ctrl'=>'Control','cmd'=>'iniPlayerList','playerList'=>$playerList);
        $this->server->send($this->fd, $obj);
    }

}