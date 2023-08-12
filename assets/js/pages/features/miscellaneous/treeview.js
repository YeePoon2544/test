"use strict";

var KTTreeview = function () {

            var _demo1 = function () {
                $('#kt_tree_11').jstree({
                    "core" : {
                        "themes" : {
                            "responsive": false
                        }
                    },
                    "types" : {
                        "default" : {
                            "icon" : "fa fa-folder"
                        },
                        "file" : {
                            "icon" : "fa fa-file"
                        }
                    },
                    "plugins": ["types"]
                });
            }

    return {
        //main function to initiate the module
        init: function () {
            _demo1();
        }
    };

}();

jQuery(document).ready(function() {
    KTTreeview.init();
});
