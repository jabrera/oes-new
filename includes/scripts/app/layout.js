Layout = {
    ready: function() {
        this.execute();
        $(window).resize(function() {
            ActionBar.fitCell();
            ActionBar.responsiveTitle();
            Layout.execute();
        })
        App.log("\tLayout initialized.");
    },
    execute: function() {
        if(App.width() > 1024) {
            BottomNavigation.sideLayout();
            if(fixedSlider)
                Layout.fixedSliderLayout();
            else
                Layout.hideSliderLayout();
        } else {
            BottomNavigation.bottomLayout();
            Layout.hideSliderLayout()
        }
        BottomSheet.fixPosition(0);
        Snackbar.fixPosition(0);
        DialogBox.fixPosition(0);
        Loading.fixPosition();
        BottomNavigation.show();
    },
    hideSliderLayout: function() {
        Layout.responsive = false;
        $(".action-bar, .data.action-bar, .bottom-navigation").css({
            "width": App.width() + "px",
            "left": "0px"
        })
        $(".view").css({
            "top": ActionBar.outerHeight() + "px",
            "left": "0px"
        })
        Slider.hide("");
        Slider.icon("arrow_back");
        ActionBar.el.find(".menu-icon").show();
        ActionBar.el.children("div:first-child .title").removeClass("pad");
    },
    fixedSliderLayout: function() {
        Layout.responsive = true;
        Slider.show("");
        Slider.icon("menu");
        $(".action-bar, .data.action-bar, .bottom-navigation").css({
            "width": App.width() - Slider.width() + "px",
            "left": Slider.width() + "px"
        })
        $(".view").css({
            "top": ActionBar.outerHeight() + "px",
            "left": Slider.width() + BottomNavigation.width() + "px"
        })
        ActionBar.responsiveTitle();
        ActionBar.el.find(".menu-icon").hide();
        ActionBar.el.find(".title").addClass("pad");
    },
    isMobile: function() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    }
}