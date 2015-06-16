var GameScene;

GameScene = cc.Scene.extend({

	gameLayer : null,

	match_bg : null,

	enter : null,

	ball : null,

	playerList : [],

	_wsiSendText : null,

	onEnter : function() {
		this._super();

		this.gameLayer = cc.Layer.create();
		this.addChild(this.gameLayer);

		// 背景
		this.match_bg = new cc.Sprite(s_match_bg);
		this.match_bg.setAnchorPoint(0, 0);
		this.match_bg.setPosition(0, 0);
		this.gameLayer.addChild(this.match_bg, 0);

		// 开始按钮
		this.enter = new Enter();
		this.enter.setPosition(510, 100);
		this.gameLayer.addChild(this.enter, 0);
	},
	
	iniBall : function(data)
	{
		// 球
		this.ball = new Ball();
		this.ball.setAnchorPoint(0.5, 0.5);
		this.ball.setPosition(data.ball.x, data.ball.y);
		this.gameLayer.addChild(this.ball, 0);
	},
	
	iniPlayerList : function(data)
	{
		// 球
		for(var i=0;i<data.playerList.length;i++)
		{
			player = new Player(data.playerList[i].type,data.playerList[i]. number);
			player.setAnchorPoint(0.5, 0.5);
			player.setPosition(data.playerList[i].x, data.playerList[i].y);
			this.gameLayer.addChild(player, 0);
			this.playerList.push(player);
		}
	},

	moveBall : function(data) {
		// 设置速度
		this.ball.setVelocity(data.velocity.x, data.velocity.y);

		self = this;
		// 移动
		this.schedule(function() {
			self.ball.move();
		}, data.interval, data.repeat);
	},

	movePlayer : function(data) {
		
		//选择球员
		player = this.playerList[data.index];
		
		// 设置速度
		player.setVelocity(data.velocity.x,
				data.velocity.y);
		// 移动
		this.schedule(function() {
			player.move();

		}, data.interval, data.repeat);
	},

});