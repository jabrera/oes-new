ActionBar = {
    ready: function() {
        this.el = $(".action-bar:not(.data)");
        this.elall = $(".action-bar");
        ActionBar.execute();
        ActionBar.fitCell();
        ActionBar.addMarginToIcons();
        ActionBar.responsiveTitle();
        ActionBar.valignItems();
        App.log("\t\tActionBar initialized.");
    },
    execute: function() {
        this.el.find(".menu-icon").click(function() {
            Slider.show("slow");
            View.slide("right");
            ActionBar.slide("right");
            BlackTrans.show();
        })
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
    responsiveTitle: function() {
        $abw = this.el.find(".title").parent().outerWidth();
        $mw = this.el.find(".menu-icon").outerWidth();
        $firstrow = this.el.find(".table:first-child");
        $secondrow = this.el.find("div[data-added]:nth-child(2)");
        $title = $firstrow.find("span.title").text();
        if($firstrow.find("span.title").css("display") == "none") {
            if($mw + $secondrow.find("span.title").outerWidth()+5 < this.el.find(".menu-icon").parent().outerWidth()) {
                $title = $secondrow.find("span.title").text();
                $secondrow.remove();
                $firstrow.find("span.title").text($title);
                $firstrow.find("span.title").show();
            }
        } else {
            if($firstrow.height() > 60) {
                if($secondrow.length == 0) {
                    $firstrow.find("span.title").hide();
                    $firstrow.after('<div class="table" data-added="1"><div class="row"><div class="cell middle"><span class="title pad">'+$title+'</span></div></div></div></div>');
                }
            } else {
                if($secondrow.length != 0) {
                    $title = $secondrow.find("span.title").text();
                    $secondrow.remove();
                    $firstrow.find("span.title").text($title);
                    $firstrow.find("span.title").show();
                }
            }
        }
    },
    valignItems: function() {
        $abh = this.elall.find("ul.nav").parent().height();
        this.elall.find("ul.nav").height($abh);
    },
    fitCell: function() {
        this.elall.find(".cell.fit").each(function () {
            if ($(this).height > 60) {
                $(this).css("width", "inherit");
            } else {
                $totalwidth = 0;
                $(this).children().each(function () {
                    $totalwidth = $(this).outerWidth();
                })
                $(this).width($totalwidth);
            }
        })
    },
    addMarginToIcons: function() {
        $("ul.nav i.md-icon").each(function() {
            $parent = $(this).parent();
            $html = $("<div/>").html($parent.html());
            $html.find("i.md-icon").remove();
            if($html.html() != "")
                $(this).css("margin-right", "8px");
            else
                $(this).css("margin", "0px 2px");
        })
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