DataActionBar = {
    ready: function() {
        this.el = $(".data.action-bar");
        App.log("\t\tDataActionBar initialized.")
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
};