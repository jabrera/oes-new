Menu = {
    ready: function() {
        Menu.execute();
        App.log("\t\tMenu initialized.")
    },
    execute: function() {
        $("html").click(function(e) {
            if(!$(e.target).hasClass(".menu")){
                $(".menu").hide();
            }
        });
        ActionBar.el.find("ul.nav > li > a").click(function() {
            $el = $(this);
            $el.siblings("ul").show();
        })

        $(".menu").each(function() {
            $(this).siblings("a").click(function(e) {
                $(".menu").hide();
                $(this).siblings(".menu").toggle();
                e.stopPropagation();
            });
        });
    }
}