Chip = {
    ready: function() {
        this.execute();
        App.log("\t\tChip initialized");
    },
    execute: function() {
        var colors = ["red", "pink", "purple", "deep-purple", "indigo", "blue", "light-blue", "cyan", "teal", "green", "light-green", "lime", "yellow", "amber", "orange", "deep-orange", "brown", "gray", "blue-gray"];
        $(".chip").each(function() {
            $icon = $(this).attr("data-icon");
            if(typeof $icon !== typeof undefined && $icon !== false) {
                if($icon == "letter") {
                    $(this).html('<span class="icon '+ colors[Math.floor(Math.random() * colors.length)]+'"></span>' + $(this).html());
                    $(this).find(".icon").text($(this).find("span:not(.icon)").text().charAt(0));
                } else if($icon == "background") {
                    $bg = $(this).attr("data-background");
                    if(typeof $bg !== typeof undefined && $bg !== false) {
                        $(this).html('<span class="icon '+ colors[Math.floor(Math.random() * colors.length)]+'"></span>' + $(this).html());
                        $(this).find(".icon").css({
                            "background-image": "url("+$bg+")"
                        }, 500);
                    }
                }
            }
            $hasButton = $(this).attr("data-hasButton");
            if(typeof $hasButton !== typeof undefined && $hasButton !== false) {
                $(this).append('<a><i class="md-icon">close</i></a>');
            }
            if($(this).find(".icon").length > 0) {
                $(this).addClass("hasIcon");
                $(this).find("span:not(.icon)").addClass("hasIcon");
            }
            if($(this).find("a").length > 0) {
                $(this).addClass("hasButton");
                $(this).find("span:not(.icon)").addClass("hasButton");
            }
        })

        $(".chip a").click(function() {
            $(this).parents(".chip").remove();
        })
    }
}