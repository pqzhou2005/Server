var Ball = cc.Sprite.extend({

	velocity : null,

	ctor : function() {
		this._super();

		this.initWithFile(s_ball);
	},

	setVelocity : function(x, y) {
		this.velocity = cc.p(1, 1);
	},

	move : function() {
		cc.log(this.velocity);
		this.setPosition(cc.pAdd(this.getPosition(), this.velocity));
	}
});
