"use strict";
// Class definition

var KTAppsEducationSchoolTeacher = function() {
	// Private functions

	// basic demo
	var _demo = function() {
		var datatable = $('#kt_datatable_contract').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						url: '//digi.library.tu.ac.th/tulib-hr/get-list-contract.php',
					},
				},
				pageSize: 10, // display 20 records per page
				serverPaging: true,
				serverFiltering: true,
				serverSorting: true,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false, // display/hide footer
			},

			// column sorting
			sortable: true,

			// enable pagination
			pagination: true,

			// columns definition
			columns: [
				 {
					field: 'thai_name',
					title: 'ชื่อ - นามสกุล',
					width: 250,
					template: function(data) {
						var number = KTUtil.getRandomInt(1, 20);
						var img = data.empid + '.jpg';
						var output = '';

						var genreIndex = KTUtil.getRandomInt(1, 5);

						// var genre = {
						// 	1: {'title': 'Mathematics, BA'},
						// 	2: {'title': 'Geography, BSc'},
						// 	3: {'title': 'History, PhD'},
						// 	4: {'title': 'Physics, MS'},
      //                       5: {'title': 'astronomy, MA'},
						// };

						output = '<div class="d-flex align-items-center">\
							<div class="symbol symbol-40 symbol-sm flex-shrink-0">\
								<img class="" src="picture/' + img + '" alt="photo">\
							</div>\
							<div class="ml-4">\
								<div class="text-dark-75 font-weight-bolder font-size-lg mb-0">' + data.prefix + ' ' + data.name + '</div>\
								 <a href="#" class="text-muted font-weight-bold text-hover-primary">' + data.pos + data.type + '</a>\
							</div>\
						</div>';

						return output;
					}
				}, {
					field: 'suborgname',
					title: 'ฝ่าย',
					template: function(row) {
						var output = '';

						output += '<a href="#" class="text-dark-50 text-hover-primary font-weight-bold">' + row.subor + '</a>';

						return output;
					}
				}, {
					field: 'emptype_name',
					title: 'ประเภท',
					template: function(row) {
						var output = '';

						output += row.emptype;

						return output;
					}
				}, {
					field: 'contract_ed_thdate',
					title: 'วันที่สัญญา',
					type: 'date',
					// width: 130,
					format: 'D/M/YYYY',
					template: function(row) {
						var output = '';

						output += '<div class="font-weight-bolder text-primary mb-0">' + row.con_ed_date + '</div>';

						return output;
					}
				}, {
					field: 'retire60',
					title: 'วันเกษียณ',
					type: 'date',
					// width: 130,
					format: 'D/M/YYYY',
					template: function(row) {
						var output = '';

						output += '<div class="font-weight-bolder text-primary mb-0">' + row.r_date + '</div>';

						return output;
					}
				}, ],
		});

		$('#kt_datatable_search_status').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'position');
		});

		$('#kt_datatable_search_type').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'emptype_name');
		});

		$('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
	};

	return {
		// public functions
		init: function() {
			_demo();
		},
	};
}();

jQuery(document).ready(function() {
	KTAppsEducationSchoolTeacher.init();
});
