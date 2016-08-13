Tooltip = {
	defaultPosition: "bottom",
	ready: function() {
		this.execute();
		App.log("\t\tTooltip initialized.");
	},
	execute: function() {
		$instance = this;
		$("[data-tooltip-text]").each(function() {
			$text = $(this).attr("data-tooltip-text");
			$pos = $(this).attr("data-tooltip-position");
			$obj = $(this);
			while(!$pos) {
				$obj = $obj.parent();
				$tag = $obj.get(0).tagName;
				$pos = $obj.attr("data-tooltip-position");
				if($tag == "HTML") {
					$pos = $instance.defaultPosition;
					break;
				}
			}
			if($(this).css("position") == "static")
				$(this).css("position", "relative");

			$(this).append('<div class="tooltip">'+$text+'</div>');
			$tooltip = $(this).find(".tooltip");
			$width = $tooltip.outerWidth();
			$height = $tooltip.outerHeight();
			$spacing = 8;
			if($pos == "bottom") {
				$tooltip.css({
					"bottom": 0-($height+$spacing)+"px",
					"left": 0,
					"margin-left": ($(this).outerWidth()-$width)/2+"px"
				});
			} else if($pos == "left") {
				$tooltip.css({
					"top": 0,
					"left": 0-($width+$spacing)+"px",
					"margin-top": ($(this).outerHeight()-$height)/2+"px"
				});
			} else if($pos == "right") {
				$tooltip.css({
					"top": 0,
					"right": 0-($width+$spacing)+"px",
					"margin-top": ($(this).outerHeight()-$height)/2+"px"
				});
			} else {
				$tooltip.css({
					"top": 0-($height+$spacing)+"px",
					"left": 0,
					"margin-left": ($(this).outerWidth()-$width)/2+"px"
				});
			}
		}).hover(function() {
			$(this).css({
				"overflow": "visible"
			})
			$(this).find(".tooltip").css({
				"display": "block"
			}).animate({
				"opacity": "1"
			}, 250);
		}, function() {
			if($(this).hasClass("ripple")) {
				$(this).css({
					"overflow": "hidden"
				})
			}
			$(this).find(".tooltip").animate({
				"opacity": "0"
			}, 100, function() {
				$(this).css("display", "none")
			});
		}).click(function() {
			if($(this).hasClass("ripple")) {
				$(this).css({
					"overflow": "hidden"
				});
			}
			$(this).find(".tooltip").animate({
				"opacity": "0"
			}, 100, function() {
				$(this).css("display", "none")
			});
		})
	}
}