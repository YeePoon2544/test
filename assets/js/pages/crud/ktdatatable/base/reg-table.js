'use strict';
// Class definition

var KTDatatableHtmlTableDemo = function() {
  // Private functions

  // demo initializer
  var demo = function() {

    var datatable = $('#kt_datatable').KTDatatable({
      data: {
        saveState: {cookie: false},
      },
      search: {
        input: $('#kt_datatable_search_query'),
        key: 'generalSearch',
      },
      layout: {
        class: 'datatable-bordered',
      },
      columns: [
        {
          field: 'DepositPaid',
          type: 'number',
        },
        // {
        //   field: 'OrderDate',
        //   type: 'date',
        //   format: 'YYYY-MM-DD',
        // }, 
        {
          field: 'Department',
          title: 'Department',
          autoHide: false,
          // callback function support for column rendering
        },
      ],
    });


    var datatable = $('#kt_datatableOut').KTDatatable({
      data: {
        saveState: {cookie: false},
      },
      search: {
        input: $('#kt_datatable_search_query_bug'),
        key: 'generalSearch',
      },
      layout: {
        class: 'datatable-bordered',
      },
      columns: [
        {
          field: 'No',
          width: 40,
          type: 'number',
          selector: false,
          textAlign: 'center',          
        },
        {
          field: 'Title',
          title: 'Title',
          width: 250,
        },
        {
          field: 'วิทยากร',
          title: 'วิทยากร',
          width: 150,
        },
        {
          field: 'ช่วงเวลาการอบรม',
          width: 200,        
        }, 
        {
          field: 'สถานที่',
          width: 150,        
        }, 
        {
          field: 'ชั่วโมงอบรม',
          width: 70,        
        },         
        {
          field: 'Year',
          width: 60, 
          selector: false,
          textAlign: 'center',       
        }, 

      ],
    });    

    $('#kt_datatable_search_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Department');
    });

    // $('#kt_datatable_search_type').on('change', function() {
    //   datatable.search($(this).val().toLowerCase(), 'Type');
    // });

    $('#kt_datatable_search_status').selectpicker();
    // $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

    $('#kt_datatable_search_bug').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Year');
    });
    $('#kt_datatable_search_bug').selectpicker();


  };

  return {
    // Public functions
    init: function() {
      // init dmeo
      demo();
    },
  };
}();

jQuery(document).ready(function() {
  KTDatatableHtmlTableDemo.init();
});
