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
class Player
{
    /**
     * 当前地图位置
     * @var unknown
     */
    private $pos;
    
    /**
     * 号码
     * @var unknown
     */
    private $number;
    
    /**
     * 队伍
     * @var unknown
     */
    private $club_id;
    
    /**
     * 擅长位置
     * @var unknown
     */
    private $good_location;
    
    /**
     * 当前位置
     * @var unknown
     */
    private $curr_location;
    
    /**
     * 完美位置
     * @var unknown
     */
    private $perfect_location;
    
    /**
     * 所有位置
     * @var unknown
     */
    private $all_location;
    
    /**
     * 身高
     * @var unknown
     */
    private $height;
    
    /**
     * 体重
     * @var unknown
     */
    private $weight;
    
    
    /**
     * 0左脚，1右脚，2双脚
     * @var unknown
     */
    private $footer;
    
    /**
     * 速度
     * @var unknown
     */
    private $pace;
    
    /**
     * 强壮
     * @var unknown
     */
    private $strength;
    
    /**
     * 耐力
     * @var unknown
     */
    private $stamina;
    
    /**
     * 易受伤
     * @var unknown
     */
    private $injury_resistance;
    
    /**
     * 传球
     * @var unknown
     */ 
    private $passing;
    
    /**
     * 触球
     * @var unknown
     */
    private $first_touch;
    
    /**
     * 控球(盘带)
     * @var unknown
     */
    private $dribbling;
    
    /**
     * 头球
     * @var unknown
     */
    private $heading;
    
    /**
     * 状态稳定度
     * @var unknown
     */
    private $consistency;
    
    /**
     * 意志力
     * @var unknown
     */
    private $mental_strength;
    
    /**
     * 领导力
     * @var unknown
     */
    private $leadership;
    
    /**
     * 积极性
     * @var unknown
     */
    private $workrate;
    
    /**
     * 射门脚法
     * @var unknown
     */
    private $finishing;
    
    /**
     * 无求跑动
     */
    private $movement;
    
    /**
     * 创造力
     * @var unknown
     */
    private $creativity;
    
    /**
     * 过人
     * @var unknown
     */
    private $crossing;
    
    /**
     * 铲断
     * @var unknown
     */
    private $tackling;
    
    /**
     * 盯人
     * @var unknown
     */
    private $marking;
    
    /**
     * 跑位
     * @var unknown
     */
    private $positioning;
    
    /**
     * 点球
     * @var unknown
     */
    private $penaltytaking;
    
    /**
     * 任意球
     * @var unknown
     */
    private $freeKicks;
    
    /**
     * 角球
     * @var unknown
     */
    private $corners;
    
    /**
     * 长传
     * @var unknown
     */
    private $long_shots;
    
    
    public function __construct()
    {
    }
    
    public function update()
    {
    	
    }
    
    public function render()
    {
    	
    }
    
    public function canPassForward($reciever,$target,$power)
    {
        
    }
    
    
    public function canPassBackward($reciever,$target,$power)
    {
    	
    }
    
    /**
     * 是否在射程以内
     */
    public function withinShotingRange()
    {
    	
    }
    
    public function handleMessage($telegram)
    {
    	
    }
    
}