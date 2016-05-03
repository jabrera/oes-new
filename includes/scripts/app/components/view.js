View = {
    ready: function() {
        this.el = $(".view");
        App.log("\t\tView initialized.");
    },
    slide: function(direction) {
        if(direction == "right") {
            this.el.animate({
                "left": "+=50",
                "right": "-=50"
            }, 500);
        } else {
            this.el.animate({
                "left": "-=50",
                "right": "+=50"
            }, 500);
        }
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