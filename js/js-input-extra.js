


$(document).ready(function() {
  var max_fields = 15; //maximum input boxes allowed
  var wrapper = $(".input_fields_Results"); //Fields wrapper
  var add_button = $(".add_field_button_Results"); //Add button ID

  var x = 1; //initlal text box count
  $(add_button).click(function(e) { //on add input button click
    e.preventDefault();
    if (x < max_fields) { //max input box allowed

      x++; //text box increment
      //$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
      $(wrapper).append(

        '<div class="product_wrapper_Results">' +
              '<div class="row" >' +
                    '<div>'+
                        '<span class="label label-xl font-weight-boldest label-rounded label-warning "><div class="css-plan-number-res" id="numfield"></div></span>'+
                    '</div>'+

                    // '<div class="col-md-2" >' +
                    //   // '<label><span class="badge badge-primary"><div class="css-plan-number-res" id="numfield"></div></span></label>'+
                    //       //'<select class="custom-select" name="withdraw[]" required>'+
                    //       '<select class="custom-select" name="withdraw[]" onchange="Rek(this.value);" required>'+
                    //          '<option value="" selected hidden>กรุณาเลือก</option>'+   
                    //          '<option value="ตนเอง">ตนเอง</option>'+
                    //          '<option value="คู่สมรส">คู่สมรส</option>'+        
                    //          '<option value="บิดา">บิดา</option>'+
                    //          '<option value="มารดา">มารดา</option>'+
                    //          '<option value="บุตร">บุตร</option>'+
                    //       '</select>'+
                    // '</div>' +


                                        '<div class="col-lg-1">'+
                                            '<select class="custom-select" name="withdraw" onchange="Rek(this.value);" required>'+    
                                                 '<option value="" selected hidden>กรุณาเลือก</option>'+   
                                                 '<option value="ตนเอง">ตนเอง</option>'+
                                                 '<option value="คู่สมรส">คู่สมรส</option>'+        
                                                 '<option value="บิดา">บิดา</option>'+
                                                 '<option value="มารดา">มารดา</option>'+
                                                 '<option value="บุตร">บุตร</option>'+
                                            '</select>'+

                                        '</div>'+

                                        '<div class="col-md-2">'+
                                            '<input class="withdraw_name form-control" type="text" value="" id="withdraw_name" name="withdraw_name[]" placeholder="ชื่อ-นามสกุล" maxlength="100" />'+
                                        '</div>'+

                                        '<div>'+
                                            '<input class="withdraw_idcard form-control" type="text" value="" id="withdraw_idcard" name="withdraw_idcard[]" placeholder="เลขประจำตัวประชาชน" maxlength="100" />'+
                                        '</div>'+

                    // '<div class="col-md-2">' +
                    //     '<input type="text" class="withdraw_name form-control " name="withdraw_name[]" placeholder="ชื่อ-นามสกุล" maxlength="100" required>' +
                    // '</div>' +

                    // '<div class="col-md-2">' +
                    //     '<input type="text" class="withdraw_idcard form-control " name="withdraw_idcard[]" placeholder="เลขประจำตัวประชาชน" maxlength="100" required>' +
                    // '</div>' +
                  
              '</div>' +
              '<br>'+
               '<a href="#" class="remove_field btn btn-icon btn-danger"><i class="fa fa-trash"></i></a>'+
              '<hr class="new">' +
      '</div>' 



        );




      
    }

      $('.css-plan-number-res').each(function(x) {
      $(this).text(x+2);
      });
  });




  $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
    e.preventDefault();
    $(this).parent('.product_wrapper_Results').remove();
    calculateTotal();
    x--;
  })

});

