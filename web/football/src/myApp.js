var mainScene;

mainScene = cc.Scene.extend({
    
	onEnter: function () {
        this._super();
    
        SocketClient.start(function(evt){
        	cc.log('ws open....');
        	
        	var token = window.sessionStorage.getItem('token');
        	
        	var obj = {"Control":"Ctrl","cmd":"loginUseToken","token":token};
        	SocketClient.send(JSON.stringify(obj));
        	cc.log(JSON.stringify(obj));
        });
	}
});