Snackbar = {
    ready: function() {
        this.el = $(".snackbar");
        this.hide(0);
        this.to;
        App.log("\t\tSnackbar initiated.");
    },
    fixPosition: function(speed) {
        var self = this;
        setTimeout(function() {
            speed *= Animation.baseSpeed;
            if(Layout.responsive) {
                self.el.animate({
                    "left": ((App.width() - self.outerWidth())/2)+(Slider.width()/2)+"px"
                }, speed);
            } else {
                self.el.animate({
                    "left": ((App.width() - self.outerWidth())/2)+"px"
                }, speed);
            }
            if(self.outerWidth()+1 >= App.width())
                self.el.addClass("fit");
            else
                self.el.removeClass("fit");
            if(self.isShown()) {
                var bottom = 0;
                if(!BottomNavigation.el.is(".side"))
                    bottom = BottomNavigation.outerHeight();
                self.el.animate({
                    "bottom": bottom+"px"
                }, 0);
            }
        }, 10)
    },
    isShown: function() {
        return (this.el.css("bottom").replace("px", "") >= 0) ? true : false;
    },
    show: function(speed) {
        speed *= Animation.baseSpeed;
        this.hide("");
        var bottom = 0;
        if(BottomNavigation.el.length != 0 && !BottomNavigation.el.is(".side"))
            bottom = BottomNavigation.outerHeight();
        this.el.animate({
            "bottom": bottom+"px"
        }, speed);
    },
    hide: function(speed) {
        speed *= Animation.baseSpeed;
        this.el.animate({
            "bottom": 0-(this.outerHeight() + 36) + "px"
        }, speed);
    },
	text: function(text) {
		clearTimeout(this.to);
		var self = this;
		if(this.isShown()) {
			this.hide(1);
			setTimeout(function() {
				self.el.html(text);
				self.fixPosition(0);
				setTimeout(function() {
					self.show(1);
					self.to = setTimeout(function() {
						self.hide(1);
					}, 5000);
				}, 100)
			}, 500)
		} else {
			self.el.html(text);
			self.fixPosition(0);
			setTimeout(function() {
				self.show(1);
				self.to = setTimeout(function() {
					self.hide(1);
				}, 5000);
			}, 100)
		}

	},
    showContent: function(content) {
        clearTimeout(this.to);
        if(this.isShown()) {
            this.hide(1);
            var self = this;
            setTimeout(function() {
                self.processContent(content);
            }, 500)
        } else
            this.processContent(content);
    },
    processContent: function(content) {
        var self = this;
        content.type = "post";
        content.data["_cl"] = content._cl;
        $.ajax({
            type: content.type,
            cache: content.cache,
            url: content.url,
            data: content.data,
            success: function(html) {
                self.el.html(html);
                self.fixPosition(0);
                setTimeout(function() {
                    self.show(1);
                    self.to = setTimeout(function() {
                        self.hide(1);
                    }, 5000);
                }, 100)
            }
        })
    },
    width: function() {
        return this.el.width();
    },
    height: function() {
        return this.el.height();
    },
    outerWidth: function() {
        return this.el.outerWidth();
    },
    outerHeight: function() {
        return this.el.outerHeight();
    }
}