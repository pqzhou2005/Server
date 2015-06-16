<?php
/**
 * Player.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id$ 
 */
namespace cls\service;
class Pos
{
    private $x;
    
    private $y;
    
    public function __construct($x,$y)
    {
    	$this->x = $x;
    	$this->y = $y;
    }
}