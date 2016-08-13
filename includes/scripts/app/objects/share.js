function Share() {
	this.link = "";
	this.social = [
		{
			name: "facebook",
			action: '<li><a id="shareFacebook"><img src="includes/images/resources/facebook.png"><span>Facebook</span></a></li>'
		},
		{
			name: "twitter",
			action: '<li><a id="shareTwitter"><img src="includes/images/resources/twitter.png"><span>Twitter</span></a></li>'
		},
		{
			name: "url",
			action: '<li><a data-clipboard-text="{{link}}" data-snackbar-text="Content copied"><i class="md-icon">content_copy</i><span>Copy to clipboard</span></a></li>'
		}
	];
	this.share = [];
}
Share.prototype = {
	ready: function() {
		var obj = this;
		$(".bottom-sheet #shareFacebook").click(function() {
			$width = 500;
			$height = 400;
			$top = ($(window).height()-$height)/2;
			$left = ($(window).width()-$width)/2;
			window.open("https://www.facebook.com/sharer/sharer.php?u="+obj.link, "_blank", "toolbar=no, scrollbars=yes, resizable=no, top="+$top+", left="+$left+", width="+$width+", height="+$height+"");
		})
		$(".bottom-sheet #shareTwitter").click(function() {
			$width = 500;
			$height = 400;
			$top = ($(window).height()-$height)/2;
			$left = ($(window).width()-$width)/2;
			window.open("https://twitter.com/home?status="+obj.link, "_blank", "toolbar=no, scrollbars=yes, resizable=no, top="+$top+", left="+$left+", width="+$width+", height="+$height+"");
		})
	},
	to: function(to) {
		this.share = to;
	},
	show: function() {
		BottomSheet.el.html('<h4>Share link</h4><ul class="grid-options ripple share"></ul>');
		var data, share;
		for(data in this.social) {
			if(this.social.hasOwnProperty(data)) {
				for(i in this.share) {
					if(this.share[i] == this.social[data].name) {
						BottomSheet.el.find("ul").append(this.social[data].action.replace("{{link}}", this.link));
					}
				}
			}
		}
		BottomSheet.el.find("ul.share a").click(function() {
			var c = $(this).attr("data-snackbar-text");
			if (typeof c !== typeof undefined && c !== false) {
				Snackbar.text(c);
			}
			BottomSheet.hide(1);
		})
		Animation.rippleEffect();
		this.ready();
		BottomSheet.show(1);
	}
}