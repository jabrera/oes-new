function DataTable($element) {
    this.element = $element;
    this.data = [];
    this.card = $element.parents(".card");
    this.ready();
}
DataTable.prototype = {
    ready: function() {
        $element = this.element;
        $obj = this;
        $element.find("tr:not(.title) td input[type=checkbox]").change(function() {
            if($(this).is(":checked")) {
                $(this).parents("tr").addClass("selected");
                $obj.data.push($(this).attr("value"));
            } else {
                $(this).parents("tr").removeClass("selected");
                $index = $obj.data.indexOf($(this).attr("value"));
                $obj.data.splice($index, 1);
            }
            $obj.isCheckAll();
            $obj.dataAction();
        })

        $element.find("tr.title td input[type=checkbox]").change(function() {
            if(this.checked)
                $obj.selectAll();
            else
                $obj.clearSelection();
        })

        this.card.find("ul.nav>li>a").click(function() {
            $text = $(this).text();
            if($text == "select_all")
                $obj.selectAll();
            else if($text == "clear")
                $obj.clearSelection();
        })
    },
    selectAll: function() {
        $obj = this;
        this.element.find("tr:not(.title) td input[type=checkbox]").each(function() {
            if(!this.checked)
                $obj.data.push($(this).attr("value"));
        }).prop("checked", true).parents("tr").addClass("selected");
        this.element.find("tr.title td input[type=checkbox]").prop("checked", true);
        this.dataAction();
    },
    clearSelection: function() {
        this.element.find("tr:not(.title) td input[type=checkbox]").prop("checked", false).parents("tr").removeClass("selected");
        this.element.find("tr.title td input[type=checkbox]").prop("checked", false);
        this.data = [];
        this.dataAction();
    },
    dataAction: function() {
        if(this.data.length > 0) {
            this.card.find(".data-action-card").animate({
                "top": "0px"
            }, 300);
            this.card.find(".data-action-card .data-label").html(this.data.length + " selected");
        } else {
            this.card.find(".data-action-card").animate({
                "top": "-100px"
            }, 300);
        }
    },
    isCheckAll: function() {
        if(this.element.find("tr:not(.title) td input[type=checkbox]").length == this.element.find("tr:not(.title) td input[type=checkbox]:checked").length)
            this.element.find("tr.title td input[type=checkbox]").prop("checked", true);
        else
            this.element.find("tr.title td input[type=checkbox]").prop("checked", false);
    },
    dumpData: function() {
        alert(this.data);
    }
}