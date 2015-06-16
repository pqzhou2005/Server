var LoginScene;
LoginScene = cc.Scene.extend({
	
	gameLayer:null,
	
	nameInput:null,
	
	passInput:null,
	
	s_login_bg:null,
	
	loginBtn:null,
	
	onEnter: function () {
        this._super();
        
        this.gameLayer = cc.Layer.create();
        this.addChild(this.gameLayer);
	
        //背景
        this.s_login_bg = new cc.Sprite(s_login_bg);
        this.s_login_bg.setAnchorPoint(0, 0);
        this.s_login_bg.setPosition(0,0);
        this.gameLayer.addChild(this.s_login_bg, 0);
        
        //名字输入框
        this.nameInput = new ccui.TextField("Please input your name", "Marker Felt", 14);
        this.nameInput.setPosition(320,440);
        this.nameInput.setAnchorPoint(0, 0.5);
        this.nameInput.setTextColor("black");
        this.nameInput.setMaxLengthEnabled(true);
        this.nameInput.setMaxLength(20);
        this.gameLayer.addChild(this.nameInput, 0);
        
        //密码输入框
        this.passInput = new ccui.TextField("Please input your passwd", "Marker Felt", 14);
        this.passInput.setPosition(320,380);
        this.passInput.setAnchorPoint(0, 0.5);
        this.passInput.setTextColor("black");
        this.passInput.setMaxLengthEnabled(true);
        this.passInput.setMaxLength(20);
        this.passInput.setPasswordEnabled(true);
        this.gameLayer.addChild(this.passInput, 0);
        
        //
        this.loginBtn = new ccui.Button(s_normal_btn, s_select_btn, s_disabled_btn, ccui.Widget.LOCAL_TEXTURE);
        this.loginBtn.setPosition(638,340);
        this.loginBtn.setTitleText("登录");
        this.gameLayer.addChild(this.loginBtn, 0);
        
        self = this;
        
        cc.eventManager.addListener({
            event: cc.EventListener.MOUSE,
            onMouseUp: function(event){
            	if(cc.rectContainsPoint(self.loginBtn.getBoundingBox(),event.getLocation()))
            	{
            		var name = self.nameInput.getString();
            		var pass = self.passInput.getString();
            		var obj = {"control":"Ctrl","cmd":"loginAction","name":name,"pass":pass};
            		cc.log(JSON.stringify(obj));
            		SocketClient.send(JSON.stringify(obj));
            	}
            },
        },this);
	}
});