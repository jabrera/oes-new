(function($) {
    "use strict";

    var showContent = function(element, content) {
        this.element = element;
        this.content = content;
        this.load();
    };

    showContent.prototype = {
        load: function() {
            var self = this;
            this.content.data["_cl"] = this.content._cl;
            $.ajax({
                type: this.content.type,
                cache: this.content.cache,
                url: this.content.url,
                data: this.content.data,
                success: function(html) {
                    self.element.html(html);
                }
            });
        }
    }
    $.fn.showContent = function(content) {
        var init = new showContent($(this), content);

        return this;
    }
})(jQuery);