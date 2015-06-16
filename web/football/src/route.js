var WebSocket = WebSocket || window.WebSocket || window.MozWebSocket;

var SocketClient = {
	
	_wsiSendText : null,
	
	start:function(onOpenFunc)
	{
		self = this;
		
		this._wsiSendText = new WebSocket("ws://chat.com:8080");
		
		this._wsiSendText.onopen = onOpenFunc;
		
		this._wsiSendText.onmessage = function(evt) {
			var textStr = "response text msg: "+evt.data;
			var ret = JSON.parse(evt.data);
			var fn = window[ret.ctrl][ret.cmd];
			cc.log(textStr);
			fn.call(null,ret);
		};
		
		this._wsiSendText.onerror = function(evt) {
			cc.log("sendText Error was fired");
		};
		
		this._wsiSendText.onclose = function(evt) {
			cc.log("_wsiSendText websocket instance closed.");
			self._wsiSendText = null;
		};
	},
	
	send: function(data)
	{
		this._wsiSendText.send(data);
	}
};
