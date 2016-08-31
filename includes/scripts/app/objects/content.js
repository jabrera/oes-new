function Content() {
    this.id = 0;
    this.url = "";
    this.cache = true;
    this.type = "post";
    this.data = {};
    this._cl = true;
}
Content.prototype = {
    addData: function(key, value) {
        this.data[key] = value;
        return this;
    },
    addDataArr: function(data) {
        var self = this;
        $.each(data, function(key, value) {
            self.data[key] = value;
        })
        return this;
    },
    direct: function() {
        this.data._direct = false;
    }
}