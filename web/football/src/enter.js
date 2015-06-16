var Enter = cc.Sprite.extend({

	self:null,
	
	ctor:function()
	{
	    this._super();
	    
	    this.initWithFile(s_enter);
	
	    self = this;
	    
	    cc.eventManager.addListener({
            event: cc.EventListener.MOUSE,
            onMouseUp: function(event){
            	if(cc.rectContainsPoint(self.getBoundingBox(),event.getLocation()))
            	{
            		var str = "Mouse Up detected, Key: " + event.getButton();
            		var obj = {"control":"Ctrl","cmd":"start"};
            		SocketClient.send(JSON.stringify(obj));
            		cc.log(JSON.stringify(obj));
            	}
            },
        },this);
	},
});