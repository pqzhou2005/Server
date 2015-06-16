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
class Match
{
    /**
     * 球
     * @var unknown
     */
    private $ball;
    
    /**
     * 主队
     * @var unknown
     */
    private $home_team;
    
    /**
     * 客队
     * @var unknown
     */
    private $away_team;
    
    /**
     * 球门
     * @var unknown
     */
    private $goal;
    
    /**
     * 边界
     * @var unknown
     */
    private $walls;
    
    /**
     * 场地尺寸
     * @var unknown
     */
    private $playArea;
    
    /**
     * 比赛是否进行中（如果不是进行中，所有的球员都要回到自己的位置）
     * @var unknown
     */
    private $beGameOn;
    
    public function __construct()
    {
    }
    
    /**
     * 每帧进行update
     */
    public function update()
    {
    	
    }
    
    /**
     * 渲染
     */
    public function render()
    {
    	
    }

}