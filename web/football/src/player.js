var Player = cc.Sprite.extend({

	velocity : null,
	
	type : null,

	ctor : function(type,number) 
	{
		this._super();

		if(type=='green')
		{
			this.initWithFile(s_green_player);
		}
		else
		{
			this.initWithFile(s_red_player);
		}
		
		label = cc.LabelTTF.create(number, "Arial", 6);  
		label.setPosition(cc.p(this.getBoundingBox().width/2, this.getBoundingBox().height/2));  
        this.addChild(label, 0);  
	},

	setVelocity : function(x, y) {
		this.velocity = cc.p(x, y);
	},

	move : function() {
		cc.log(this.velocity);
		this.setPosition(cc.pAdd(this.getPosition(), this.velocity));
	}
});
