<?php
/**
 * Utils.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id: Utils.php 2143 2015-05-22 09:32:02Z zhoupengqian $ 
 */
namespace sys;

class Utils
{

    /**
     * 获取客户端IP
     *
     * @return string
     */
    public static function getClientIP ()
    {
        if (isset($_SERVER))
        {
            if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            {
                $realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            }
            else if (isset($_SERVER["HTTP_CLIENT_IP"]))
            {
                $realip = $_SERVER["HTTP_CLIENT_IP"];
            }
            else
            {
                $realip = $_SERVER["REMOTE_ADDR"];
            }
        }
        else
        {
            if (getenv("HTTP_X_FORWARDED_FOR"))
            {
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            }
            else if (getenv("HTTP_CLIENT_IP"))
            {
                $realip = getenv("HTTP_CLIENT_IP");
            }
            else
            {
                $realip = getenv("REMOTE_ADDR");
            }
        }
        
        return addslashes($realip);
    }

    public static function userHash ($uid, $conf)
    {
        $n = count($conf);
        $uid = sprintf('%u', crc32($uid));
        $i = $uid % $n;
        return $conf[$i];
    }

    public static function convertUrlQuery ($query)
    {
        $queryParts = explode('&', $query);
        $params = array();
        foreach ($queryParts as $param)
        {
            if(!$param) continue;
            $item = explode('=', $param);
            if(count($item)!=2) continue; 
            if (!isset($params[$item[0]]))
            {
                $params[$item[0]] = $item[1];
            }
            else
            {
                if (is_array($params[$item[0]]))
                {
                    $params[$item[0]][] = $item[1];
                }
                else
                {
                    $params[$item[0]] = array(
                            $params[$item[0]],
                            $item[1]
                    );
                }
            }
        }
        return $params;
    }

    public static function buildUrlQuery ($params)
    {
        $querys = array();
        foreach ($params as $key => $value)
        {
            $querys[] = $key . '=' . $value;
        }
        $query = $querys ? implode(',', $querys) : '';
        return $query;
    }

    public static function makeSign ($params_array, $secretKey)
    {
        $str = '';
        ksort($params_array);
        foreach ($params_array as $k => $v)
        {
            $str .= "$k=$v";
        }
        $str .= $secretKey;
        
        return md5($str);
    }

    public static function getCurrentTime ()
    {
        if (PHP_SAPI == 'cli') return time();
        else return $_SERVER['REQUEST_TIME'];
    }

    public static function create_guid() {
        $charid = strtoupper(md5(uniqid(mt_rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
        .substr($charid, 0, 8).$hyphen
        .substr($charid, 8, 4).$hyphen
        .substr($charid,12, 4).$hyphen
        .substr($charid,16, 4).$hyphen
        .substr($charid,20,12)
        .chr(125);// "}"
        return $uuid;
    }
}
?>