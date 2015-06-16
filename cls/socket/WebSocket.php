<?php
/**
 * Server.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id$ 
 */
namespace cls\socket;

class WebSocket
{

    private $server;

    private $connections = array();

    private $users = array();

    private $tokenList = array();

    public static $instance = null;

    public function __construct ()
    {
        $config = \sys\Config::getInstance();
        $this->server = new \swoole_websocket_server($config->host, $config->port);
    }

    public static function getInstance ()
    {
        if (self::$instance == null)
        {
            self::$instance = new WebSocket();
        }
        return self::$instance;
    }
    
    public function addConnection($name,$fd)
    {
    	$this->connections[$fd] = $name;
    }

    public function addUsers ($fd, $name)
    {
        $this->users[$name] = $fd;
        $this->addConnection($name, $fd);
    }

    public function addToken ($name, $token)
    {
        $this->tokenList[$token] = $name;
    }

    public function onOpen ($server, $request)
    {}

    public function onMessage ($server, $frame)
    {
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        $data = json_decode($frame->data, true);
        
        if ($data['cmd'] == 'loginUseToken')
        {
            if (isset($this->tokenList[$data['token']]))
            {
                $name = $this->tokenList[$data['token']];
                
                $this->addUsers($frame->fd, $name);
                
                // 显示主界面
                $obj = array(
                        'ctrl' => 'Control',
                        'cmd' => 'showGame'
                );
                $json = json_encode($obj);
                $server->push($frame->fd, $json);
            }
            else
            {
                // 显示登录界面
                $obj = array(
                        'ctrl' => 'Control',
                        'cmd' => 'showLogin'
                );
                $json = json_encode($obj);
                $server->push($frame->fd, $json);
            }
        }
        elseif (isset($this->connections[$frame->fd]))
        {
            $cls = '\cls\ctrl\\' . $data['control'];
            $func = $data['cmd'];
            $cls = new $cls($frame->fd, $data);
            $cls->$func();
        }
        else
        {
            if (isset($data['name']) && isset($data['pass']))
            {
                $userDao = new \cls\dao\User();
                $user = $userDao->getUser($data['name']);
                if (empty($user))
                {
                    $userDao->setUser($data['name'], array(
                            'name' => $data['name'],
                            'pass' => md5($data['pass'])
                    ));
                    
                    $this->addUsers($frame->fd, $data['name']);
                    
                    // 发放token,跳转主界面
                    $token = \sys\Utils::create_guid();
                    $this->addToken($data['name'], $token);
                    
                    $obj = array(
                            'ctrl' => 'Control',
                            'cmd' => 'showGame',
                            'token' => $token
                    );
                    $json = json_encode($obj);
                    $server->push($frame->fd, $json);
                }
                else
                {
                    if ($user['pass'] == md5($data['pass']))
                    {
                        $this->addUsers($frame->fd, $data['name']);
                        
                        // 发放token,跳转主界面
                        $token = \sys\Utils::create_guid();
                        $this->addToken($data['name'], $token);
                        
                        $obj = array(
                                'ctrl' => 'Control',
                                'cmd' => 'showGame',
                                'token' => $token
                        );
                        $json = json_encode($obj);
                        $server->push($frame->fd, $json);
                    }
                    else
                    {
                        // 密码不正确
                        $obj = array(
                                'ctrl' => 'control',
                                'cmd' => 'showLogin',
                                'errorTips' => '密码不正确'
                        );
                        $json = json_encode($obj);
                        $server->push($frame->fd, $json);
                    }
                }
            }
        }
    }

    public function sendByName ($name, $obj)
    {
        $fd = $this->users[$name];
        $json = json_encode($obj);
        $this->server->push($fd, $json);
    }
    
    public function send ($fd, $obj)
    {
        $json = json_encode($obj);
        $this->server->push($fd, $json);
    }

    public function start ()
    {
        $this->server->on('open', array(
                $this,
                'onOpen'
        ));
        
        $this->server->on('message', array(
                $this,
                'onMessage'
        ));
        
        $this->server->on('close', function  ($ser, $fd)
        {
            echo "client {$fd} closed\n";
        });
        
        $this->server->start();
    }

}