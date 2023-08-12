"use strict";
var KTDatatablesDataSourceHtml = function() {

	var initTableB = function() {
		var tableContract = $('#kt_datatable_contract');

		// begin first table
		tableContract.DataTable({
			responsive: true,
			"columnDefs": [
    		{ "width": "22%", "targets": 5 }
  			],
			"order": [[ 6, "asc" ], [ 0, "asc" ]]
		});

	};
	

	return {

		//main function to initiate the module
		init: function() {
			initTableB();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceHtml.init();
});
