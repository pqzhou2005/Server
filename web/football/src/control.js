var Control = {
	
	showLogin:function(data)
	{
		cc.director.pushScene(new LoginScene());
	},
		
	showGame:function(data)
	{
		if('token' in data)
		{
			 window.sessionStorage.setItem('token',data.token);
		}
		
		cc.director.pushScene(new GameScene());
	},
	
	iniBall:function(data)
	{
		cc.log(data.interval);
		
		var runningScene = cc.director.getRunningScene();
		runningScene.iniBall(data);
	},
	
	iniPlayerList:function(data)
	{
		cc.log(data.interval);
		
		var runningScene = cc.director.getRunningScene();
		runningScene.iniPlayerList(data);
	},
	
	moveBall:function(data)
	{
		cc.log(data.interval);

		var runningScene = cc.director.getRunningScene();
		runningScene.moveBall(data);
	},
	
	movePlayer:function(data)
	{
		var runningScene = cc.director.getRunningScene();
		runningScene.movePlayer(data);
	}
};