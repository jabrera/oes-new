BottomNavigation = {
    ready: function () {
        this.el = $(".bottom-navigation");
        this.el.find("a").click(function() {
            BottomNavigation.el.find("a").removeAttr("selected");
            $(this).attr("selected", '');
        })
        App.log("\t\tBottomNaviation initiated.");
    },
    sideLayout: function() {
        this.el.addClass("side");
        this.el.css({
            "top": 0+ActionBar.el.height()+"px"
        })
    },
    bottomLayout: function() {
        this.el.removeClass("side");
        this.el.css({
            "top": "auto"
        })
    },
    show: function() {
        this.el.show();
    },
    hide: function() {
        this.el.hide();
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