Slider = {
    ready: function() {
        this.el = $(".slider");
        this.readyMoreOptions();
        this.execute();
        App.log("\t\tSlider initialized.");
    },
    execute: function() {
        this.el.find(".menu-icon").click(function() {
            if(!Layout.responsive) {
                Slider.hide("slow");
                View.slide("left");
                ActionBar.slide("left");
                BlackTrans.hide();
            }
        })
    },
    expandSelected: function() {
        this.el.find("a[selected]").each(function() {
            $(this).parents("li").children("ul").css("max-height", "500px");
            alert($(this).find("i.md-icon").length);
            $(this).children("i.more-options-icon").addClass("down");
        })
    },
    readyMoreOptions: function() {
        this.el.find("ul.nav > li").each(function() {
            if(!($(this).children("ul").length == 0)) {
                if($(this).find("a[selected]").length != 0) {
                    $(this).children("a").append('<i class="md-icon more-options-icon down">keyboard_arrow_right</i>');
                    $(this).children("ul").css("max-height", "500px");
                } else
                    $(this).children("a").append('<i class="md-icon more-options-icon">keyboard_arrow_right</i>');
            }
        })

        this.el.find("ul.nav > li > a").click(function() {
            if($(this).children("i.more-options-icon.down").length != 0) {
                $(this).parents("li").children("ul").css("max-height", "0px");
                $(this).children("i.more-options-icon").removeClass("down");
            } else {
                Slider.el.find("ul.nav ul").css("max-height", "0px");
                Slider.el.find("ul.nav i.more-options-icon").removeClass("down");
                $(this).parents("li").children("ul").css("max-height", "500px");
                $(this).children("i.more-options-icon").addClass("down");
            }
        })
    },
    hide: function(speed) {
        if(speed == "")
            this.el.css("left", "-308px");
        else if (speed == "slow")
            this.el.animate({
                "left": "-308px"
            }, 500)
    },
    show: function(speed) {
        if(speed == "")
            this.el.css("left", "0px");
        else if (speed == "slow")
            this.el.animate({
                "left": "0px"
            }, 500)
    },
    isShown: function() {
        return (this.el.css("left") == "0px") ? true : false;
    },
    icon: function(display) {
        this.el.find("a.menu-icon i.md-icon").text(display)
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