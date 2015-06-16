<?php
/**
 * Yphp.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id$ 
 */
namespace sys;

class Yphp
{

    /**
     * 
     */
    public function bootstrap ()
    {
        // 自动加载类
        spl_autoload_register('sys\Yphp::autoLoad');
    }


    /**
     * 自动加载类
     * 
     * @param unknown $class_name            
     */
    public static function autoLoad ($className)
    {
        if (strpos($className, '\\') !== false)
        {
            $classFile = ROOT_PATH . '/' . str_replace('\\', '/', $className) .
                     '.php';
            if ($classFile === false || ! is_file($classFile))
            {
                return;
            }
        }
        else
        {
            return;
        }
        
        include ($classFile);
    }
}

