View = {
    ready: function() {
        this.el = $(".view");
		this.whenScroll();
		this.el.scroll(function() {
			View.whenScroll();
		})
        App.log("\t\tView initialized.");
    },
	whenScroll: function() {
		setTimeout(function() {
			$(".view>.cover").each(function() {
				//console.log("Cover " + $i + ": " + Math.floor($(".view").scrollTop()+60) + " >= " + Math.floor($(this).parent().scrollTop() + $(this).offset().top) + " && " + Math.floor($(".view").scrollTop()+60) + " <= " + Math.floor($(this).parent().scrollTop() + $(this).offset().top + $(this).outerHeight()));
				if(Math.floor($(".view").scrollTop()+60) >= Math.floor($(this).parent().scrollTop() + $(this).offset().top) && Math.floor($(".view").scrollTop()+60) <= Math.floor($(this).parent().scrollTop() + $(this).offset().top + $(this).outerHeight()) && ActionBar.el.css("background-color") == $(this).css("background-color")) {
					//console.log(ActionBar.el.css("background-color") + " " + $(this).css("background-color"));
					ActionBar.el.addClass("flat");
					return false;
				} else {
					ActionBar.el.removeClass("flat");
				}
			})
		}, 20);
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