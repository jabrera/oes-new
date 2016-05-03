Utility = {
    classExist: function($element, $class) {
        return $.grep($element.className.split(" "), function(v, i){
            return v.indexOf($class) === 0;
        }).join();
    }
}