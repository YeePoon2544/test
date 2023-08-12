"use strict";
var KTDatatablesDataSourceHtml = function() {

// --------------------------datatable insignia----------------------
	var initTableC = function() {
		var tableC = $('#kt_datatable_insignia');

		// begin first table
		tableC.DataTable({
			responsive: true,
			"columnDefs": [
    		{ "width": "22%", "targets": 7 }
  			],
			"order": [[ 6, "asc" ], [ 0, "asc" ]]
		});

	};
// --------------------------datatable health----------------------
	var initTableAA = function() {
		var tableAA = $('#kt_datatable_profile');

		// begin first table
		tableAA.DataTable({
			responsive: true,
			// "columnDefs": [
   //  		{ "width": "80%", "targets": -5 }
  	// 		],            
			"order": [[ 4, "desc" ], [ 3, "asc" ]]
		});

	};

// --------------------------datatable health----------------------
	var initTableA = function() {
		var tableA = $('#kt_datatable_health');

		// begin first table
		tableA.DataTable({
			responsive: true,
			"columnDefs": [
    		{ "width": "22%", "targets": 5 }
  			],
			"order": [[ 4, "asc" ], [ 2, "desc" ]]
		});

	};

// --------------------------datatable health----------------------
	var initTableApp = function() {
		var tableApp = $('#kt_datatable_AppHealth');

		// begin first table
		tableApp.DataTable({
			responsive: true,
			"columnDefs": [
    		{ "width": "22%", "targets": 5 }
  			],
			"order": [ 2, "asc" ]
		});

	};


// --------------------------datatable contract----------------------
	var initTableB = function() {
		var tableB= $('#kt_datatable_contract2');

		// begin first table
		tableB.DataTable({
			responsive: true,
			"columnDefs": [
    		{ "width": "22%", "targets": 1 }
  			],
			"order": [[ 8, "asc" ], [ 0, "asc" ]]
		});

	};	
// --------------------------datatable person----------------------
	var initTableD = function() {
		var tableD= $('#kt_datatable_person');

		// begin first table
		tableD.DataTable({
			responsive: true,
			"order": [[ 0, "asc" ], [ 1, "asc" ]]
		});

	};		
// ----------------end---------------------
	return {

		//main function to initiate the module
		init: function() {
			initTableAA();
			initTableA();
			initTableApp();
			initTableB();
			initTableC();
			initTableD();
		},

	};

}();

jQuery(document).ready(function() {
	KTDatatablesDataSourceHtml.init();
});
