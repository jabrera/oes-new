Loading = {
    ready: function() {
        this.el = $(".loading");
        this.fixPosition();
        App.log("\t\tLoading initiated.");
    },
    isShown: function() {
        return (this.el.css("top").replace("px", "") >= 0) ? true : false;
    },
    fixPosition: function() {
        var self = this;
        setTimeout(function() {
            if(Layout.responsive) {
                self.el.css({
                    "left": ((App.width() - self.outerWidth())/2)+(Slider.width()/2)+"px"
                });
            } else {
                self.el.css({
                    "left": ((App.width() - self.outerWidth())/2)+"px"
                });
            }
            if(self.isShown()) {
                self.el.css("top", ActionBar.outerHeight()/2+"px");
            }
        }, 10);
    },
    show: function() {
        var height = ActionBar.outerHeight()+24;
        this.el.animate({
            "top": height+12+"px",
            "opacity": "1"
        }, 300).animate({
            "top": height+"px"
        }, 400);
    },
    hide: function() {
        var height = ActionBar.outerHeight()+24;
        this.el.animate({
            "top": height+12+"px"
        }, 400).animate({
            "top": (0-this.el.outerHeight() - 10) + "px",
            "opacity": "0"
        });
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