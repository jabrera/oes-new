Animation = {
    ready: function() {
        App.log("\tInitializing animation...");
        this.rippleEffect();
        //this.baseSpeed = 500;
        this.baseSpeed = 500;
        App.log("\t\tRipple effect initialized.");
        App.log("\tAnimation initialized.")
    },
    rippleEffect: function() {
		$(".ripple").not("a").each(function() {
			$(this).find("a:not(.noripple)").addClass("ripple");
		})
        var ink, d, x, y;
        $("a").click(function(e){
            if($(this).hasClass("ripple")) {
                $clicked = $(this);
                if($clicked.children(".ink").length == 0)
                    $clicked.prepend("<span class=\"ink\"></span>");
                ink = $clicked.children(".ink");
                ink.removeClass("animate");
                if(!ink.height() && !ink.width()) {
                    d = Math.max($clicked.outerWidth(), $clicked.outerHeight());
                    ink.css({height: d, width: d});
                }
                x = e.pageX - $clicked.offset().left - ink.width()/2;
                y = e.pageY - $clicked.offset().top - ink.height()/2;
                ink.css({top: y+"px", left: x+"px"}).addClass("animate");
                setTimeout(function() {
                    ink.remove();
                }, 650)
            }
        });
    }
}