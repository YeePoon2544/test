$(document).ready(function() {
   // var name = document.getElementById("name").value;

    for (let i = 1; i <= 5; i++) {

    $('.txtStrategic_obj1'+i).show();
    $('.txtStrategic_obj2'+i).show();
    $('.txtStrategic_obj3'+i).hide();
    $('.txtStrategic_obj4'+i).hide();
    $('.txtStrategic_obj5'+i).show();
    $('.txtStrategic_obj6'+i).show();

    //$('.Strategic_obj1').hide()
    $(".txtstrategy"+i).change(function() {
        var value = $(".txtstrategy"+i+" option:selected").val();
        var name = document.getElementById("name").value;
        var id_card = document.getElementById("id_card").value;

        if (value == "ตนเอง") {
           // $('.Strategic_obj1').show();
            $('.txtStrategic_obj1'+i).show();
            $('.txtStrategic_obj1'+i).val(name);
            $(".txtStrategic_obj1"+i).prop('disabled', false);

            $('.txtStrategic_obj2'+i).show();
            $('.txtStrategic_obj2'+i).val(id_card);
            $(".txtStrategic_obj2"+i).prop('disabled', false);

            $('.txtStrategic_obj3'+i).hide();
            $('.txtStrategic_obj4'+i).hide();
            
            
        } else if (value == "บุตร") {
           // $('.Strategic_obj1').show();
            $('.txtStrategic_obj1'+i).show();
            $('.txtStrategic_obj1'+i).val("");
            $(".txtStrategic_obj1"+i).prop('disabled', false);

            $('.txtStrategic_obj2'+i).show();
            $('.txtStrategic_obj2'+i).val("");
            $(".txtStrategic_obj2"+i).prop('disabled', false);

            $('.txtStrategic_obj3'+i).show();
            $('.txtStrategic_obj4'+i).show();

        } else {
           // $('.Strategic_obj1').show();
            $('.txtStrategic_obj1'+i).show();
            $('.txtStrategic_obj1'+i).val("");
            $(".txtStrategic_obj1"+i).prop('disabled', false);

            $('.txtStrategic_obj2'+i).show();
            $('.txtStrategic_obj2'+i).val("");
            $(".txtStrategic_obj2"+i).prop('disabled', false);

            $('.txtStrategic_obj3'+i).hide();
            $('.txtStrategic_obj4'+i).hide();
        }
    });



}
});
// $(document).ready(function() {

//     $('.txtStrategic_obj12').hide();
//     $('.txtStrategic_obj22').hide();
//     $('.txtStrategic_obj32').hide();
//     $('.txtStrategic_obj42').hide();
//     $('.txtStrategic_obj52').hide();
//     $('.txtStrategic_obj502').show();
//     $('.Strategic_obj2').hide()
//     $(".txtstrategy2").change(function() {
//         var value = $(".txtstrategy2 option:selected").val();
//         if (value == "5") {
//             $('.Strategic_obj2').show();
//             $('.txtStrategic_obj12').show();
//             $('.txtStrategic_obj22').hide();
//             $('.txtStrategic_obj32').hide();
//             $('.txtStrategic_obj42').hide();
//             $('.txtStrategic_obj52').hide();
//             $('.txtStrategic_obj502').hide();
//             //document.getElementsByClassName("txtStrategic_obj1")[0].disabled = false;  
//             $(".txtStrategic_obj12").prop('disabled', false);
//         } else if (value == "6") {
//             $('.Strategic_obj2').show();
//             $('.txtStrategic_obj12').hide();
//             $('.txtStrategic_obj22').show();
//             $('.txtStrategic_obj32').hide();
//             $('.txtStrategic_obj412').hide();
//             $('.txtStrategic_obj52').hide();
//             $('.txtStrategic_obj502').hide();
//             $(".txtStrategic_obj22").prop('disabled', false);
//         } else if (value == "7") {
//             $('.Strategic_obj2').show();
//             $('.txtStrategic_obj12').hide();
//             $('.txtStrategic_obj22').hide();
//             $('.txtStrategic_obj32').show();
//             $('.txtStrategic_obj42').hide();
//             $('.txtStrategic_obj52').hide();
//             $('.txtStrategic_obj502').hide();
//             $(".txtStrategic_obj32").prop('disabled', false);
//         } else if (value == "8") {
//             $('.Strategic_obj2').show();
//             $('.txtStrategic_obj12').hide();
//             $('.txtStrategic_obj22').hide();
//             $('.txtStrategic_obj32').hide();
//             $('.txtStrategic_obj42').show();
//             $('.txtStrategic_obj52').hide();
//             $(".txtStrategic_obj42").prop('disabled', false);
//         } else if (value == "9") {
//             $('.Strategic_obj2').show();
//             $('.txtStrategic_obj12').hide();
//             $('.txtStrategic_obj22').hide();
//             $('.txtStrategic_obj32').hide();
//             $('.txtStrategic_obj42').hide();
//             $('.txtStrategic_obj52').show();
//             $(".txtStrategic_obj52").prop('disabled', false);
//         } else {
//             $('.Strategic_obj2').hide();
//             $('.txtStrategic_obj12').hide();
//             $('.txtStrategic_obj22').hide();
//             $('.txtStrategic_obj32').hide();
//             $('.txtStrategic_obj42').hide();
//             $('.txtStrategic_obj52').hide();
//             $('.txtStrategic_obj502').show();
//             $(".txtStrategic_obj502").prop('disabled', false);
//         }
//     });
// });