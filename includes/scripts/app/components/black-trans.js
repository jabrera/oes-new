BlackTrans = {
    ready: function() {
        this.el = $(".black-trans");
        this.el.click(function() {
            if(!Loading.isShown()) {
                if(BottomSheet.isShown())
                    BottomSheet.hide(1);
                DialogBox.hide();
                if(!Layout.responsive && Slider.isShown()) {
                    Slider.hide("slow");
                    ActionBar.slide("left");
                    View.slide("left");
                }
            }
        })
    },
    show: function() {
        this.el.css("opacity", "0");
        this.el.show();
        this.el.animate({
            "opacity": "1"
        }, 250);
    },
    hide: function() {
        var self = this;
        this.el.animate({
            "opacity": "0"
        }, 250, function() {
            self.el.hide();
        });
    }
}