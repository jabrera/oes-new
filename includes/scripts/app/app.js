var App,
    Components,
    Animation,
    Layout;
App = {
    initialize: function() {
        this.el = $(window);
        App.log("Initializing app...");
        Components.ready();
        Animation.ready();
        Layout.ready();
        App.log("App initialized.");
        App.afterLoad();
    },
    log: function(msg) {
        if(Config.development == 1)
            console.log(msg);
    },
    afterLoad: function() {
        $("i.md-icon").css("font-size", "24px");
        $.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
            options.async = true;
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
$(document).ready(function() {
    App.initialize();
});