<?php
/**
 * Goal.php 注释
 * 
 * @package 
 * @subpackage 
 * @author pqzhou pengqian.zhou@ifreeteam.com
 * $Id$ 
 */
namespace cls\service;
class Goal
{
    private $ball;
    
    /**
     * 左门柱
     * @var unknown
     */
    private $leftPost;
    
    /**
     * 右门柱
     * @var unknown
     */
    private $rightPost;
    
    /**
     * 球门朝向
     * @var unknown
     */
    private $facing;
    
    /**
     * 进球数
     * @var unknown
     */
    private $numGoals;
    
    /**
     * 球门线中间位置
     */
    private $center;
    
    public function __construct($leftPost,$rightPost,$facing)
    {
        $this->leftPost = $leftPost;
        $this->reghtPost = $rightPost;
        $this->facing = $facing;
    }
    
    /**
     * 是否进球
     * @param unknown $ball
     */
    public function scored($ball)
    {
    	
    }
    
}