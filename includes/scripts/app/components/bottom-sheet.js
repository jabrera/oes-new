BottomSheet = {
    ready: function() {
        this.el = $(".bottom-sheet");
        this.hide(0);
        App.log("\t\tBottomSheet initiated.");
    },
    isShown: function() {
        return (this.el.css("bottom").replace("px", "") >= 0) ? true : false;
    },
    showContent: function(content) {
        Loading.show();
        var self = this;
        content.type = "post";
        content.data["_cl"] = content._cl;
        content.data["_direct"] = true;
        $.ajax({
            type: content.type,
            cache: content.cache,
            url: content.url,
            data: content.data,
            success: function(html) {
                self.el.html(html);
                self.fixPosition(0);
                Loading.hide();
                self.show(1);
            }
        })
    },
    show: function(speed) {
        BlackTrans.show();
        this.el.show();
        speed *= Animation.baseSpeed;
        this.el.animate({
            "bottom": "0px"
        }, speed);
    },
    hide: function(speed) {
        BlackTrans.hide();
        speed *= Animation.baseSpeed;
        this.el.animate({
            "bottom": 0-(this.outerHeight() + 36) + "px"
        }, speed, function() {
            BottomSheet.el.hide();
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
    },
    fixPosition: function(speed) {
        speed *= Animation.baseSpeed;
        if(Layout.responsive) {
            this.el.animate({
                "left": ((App.width() - this.width())/2)+(Slider.width()/2)+"px"
            }, speed);
        } else {
            this.el.animate({
                "left": ((App.width() - this.width())/2)+"px"
            }, speed);
        }
    }
}