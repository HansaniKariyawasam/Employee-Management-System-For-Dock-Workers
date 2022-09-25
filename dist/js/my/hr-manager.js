$( document ).ready(function() {

//          Validate the Employee name text - Only alphabet can be input

    $("#txtEmp_name").keydown(function (e) {
        // console.log(e.keyCode);
        // Allow: delete,backspace,tab, escape, enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
            // Allow: Ctrl/cmd+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+C
            (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+X
            (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Disable: 0 to 9
        if ((e.keyCode >= 48 && e.keyCode <= 57) ||
            //Disable: Number keypad
            (e.keyCode >= 96 && e.keyCode <= 105) ||
             //Disable: Arithmetic operation in number pad
            (e.keyCode>=106 && e.keyCode<=111) ||
             //Disable: Special characters (<>?:"{}|~`,./;'[]\)
            (e.keyCode>=186 && e.keyCode<=231)) {
            e.preventDefault();
        }
    });

//...................................................................................................

//      Validate NIC number textfiled - Only number can be input

    $("#txtNIC").keydown(function (e) {
        document.getElementById("txtNIC").style.border="1px solid white";
        // console.log(e.keyCode);
        // Allow: delete,backspace,tab, escape, enter, v, x
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13,86,88]) !== -1 ||
            // Allow: Ctrl/cmd+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+C
            (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+X
            (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }

    });

    $('#txtNIC').change(function () {
        var nic = $('#txtNIC').val();
        var regExp=/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/;
        if(!regExp.test(nic)){
            // console.log("Error");
            $("#txtNIC").focus();
            document.getElementById("txtNIC").style.border="1px solid red";
            return;
        }else{
            document.getElementById("txtNIC").style.border="1px solid white";
            return;
        }
    });
//.................................................................................................................

//      Validate the telephone no - Only numbers can be input

    $("#txtTel_no").keydown(function (e) {
        document.getElementById("txtTel_no").style.border="1px solid white";
        // console.log(e.keyCode);
        // Allow: delete,backspace,tab, escape, enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13,32]) !== -1 ||
            // Allow: Ctrl/cmd+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+C
            (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+X
            (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $('#txtTel_no').change(function () {
        var tel_no = $('#txtTel_no').val();
        var regExp=/^[0-9]{3}[0-9]{3}[0-9]{4}$/;
        if(!regExp.test(tel_no)){
            // console.log("Error");
            $("#txtTel_no").focus();
            document.getElementById("txtTel_no").style.border="1px solid red";
            return;
        }else{
            document.getElementById("txtTel_no").style.border="1px solid white";
            return;
        }
    });

//.................................................................................

//    Validate the basic salary textfield - Only numbers can be input

    $("#txtBasic_salary").keydown(function (e) {
        document.getElementById("txtBasic_salary").style.border="1px solid white";
        console.log(e.keyCode);
        // Allow: delete,backspace,tab, escape, enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13,32]) !== -1 ||
            // Allow: Ctrl/cmd+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+C
            (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+X
            (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105) || e.keyCode===110) {
            e.preventDefault();
        }
    });

    $('#txtBasic_salary').change(function () {
        // var basic_salary = $('#txtBasic_salary').val();
        // var regExp=/^[-+]?[0-9]+\.[0-9][0-9]+$/;
        // if(!regExp.test(basic_salary)){
        //     // console.log("Error");
        //     $("#txtBasic_salary").focus();
        //     document.getElementById("txtBasic_salary").style.border="1px solid red";
        //     return;
        // }else{
        //     // console.log("True");
        //     document.getElementById("txtBasic_salary").style.border="1px solid white";
        //     return;
        // }
    });

//...........................................................................................

//          Validate the account no textfield - Only numbers can input(2500.00)

    $("#txtAcc_no").keydown(function (e) {
        // console.log("Enter the txt acc");
        document.getElementById("txtAcc_no").style.border="1px solid white";
        // console.log(e.keyCode);
        // Allow: delete,backspace,tab, escape, enter
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13,32,110]) !== -1 ||
            // Allow: Ctrl/cmd+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+C
            (e.keyCode === 67 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: Ctrl/cmd+X
            (e.keyCode === 88 && (e.ctrlKey === true || e.metaKey === true)) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
//...................................................................................................................

//     Change the visibility of the married details
    $('#divChildren_chckbx').hide();
    $('#divChildren').hide();
    $( "#married" ).click(function() {
        if( $(this).is(':checked') ){
            console.log('married checked');
            $('#divChildren_chckbx').show();
            $('#divMarital_details').show();
        }
    });
    $( "#unmarried" ).click(function() {
        if( $(this).is(':checked') ){
            console.log('unmarried checked');
            $('#divMarital_details').hide();
            $('#divMarital_details_sum').hide();
        }
    });
// ............................................

    $( "#no_children" ).click(function() {
        $('#divChildren').toggle(this.checked);
        $('#divMarital_details_sum').toggle(this.checked);
        // if( $(this).is(':checked') ){
        //     $('#divChildren').hide();
        //     $('#divMarital_details_sum').hide();
        // }
    });

//     Add child DOB
//     $("#btnAdd").click(function(){
//         var dob = $("#child_dob").val();
//
//         if (dob.trim().length === 0){
//             $("#child_dob").focus();
//             $("#child_dob").addClass("error");
//             return;
//         }
//
//         var id = generateId();
//
//         $("#tblChildren tbody").append('<tr>' +
//             '<td>' + id + ' </td>' +
//             '<td>' + dob + '</td>' +
//             // '<td><div class="deleteRow" style="cursor: pointer" aria-expanded="false"><i class="mdi mdi-delete"></i><span class="hide-menu">Remove</span></div></td>' +
//             '</tr>');
//
//         $("#tblChildren_sum tbody").append('<tr>' +
//             '<td>' + id + ' </td>' +
//             '<td>' + dob + '</td>' +
//             '</tr>');
//
//         // displayTableFooter();
//
//         $("#child_dob").val("");
//
//
//         //   Rmove all the child DOBs
//         $("#btnRemove").click(function () {
//             $('#tblChildren tr').remove();
//             $('#tblChildren_sum tr').remove();
//         });


        // $(".deleteRow").click(function () {
        //     var row = $(this).parents("tr");
        //     var deleteRowNo=$(this).parents("tr").find('td:first').text();
        //     console.log("delete row :"+deleteRowNo);
        //     document.getElementById("tblChildren_sum").deleteRow(deleteRowNo);
        //     row.fadeOut(500);
        //     setTimeout(function(){
        //         $(row).remove();
        //     },600);
        //
        // });

    // });

    // function generateId(){
    //     if ($("#tblChildren tbody tr:last-child td:first-child").length === 0){
    //         return 1;
    //     }else{
    //         $("#tblChildren tfoot").hide();
    //         return (parseInt($("#tblChildren tbody tr:last-child td:first-child").text()) + 1);
    //     }
    // }
//..............................................................................................................

//          Set values to section of summary


    $('#unmarried,#married').click(function () {
        // $('#divMarital_details_sum').hide();
        var emp_name=document.getElementById("txtEmp_name").value;
        var nic=document.getElementById("txtNIC").value;
        var tel_no=document.getElementById("txtTel_no").value;
        var address=document.getElementById("txtAddress").value;
        var basic_salary=document.getElementById("txtBasic_salary").value;
        var bank=$( "#bank option:selected" ).text();
        var branch=$( "#branch option:selected" ).text();
        var acc_no=document.getElementById("txtAcc_no").value;
        var team=$( "#team option:selected" ).text();
        var marital_status=$("input:radio[name=marital_status]:checked").val();


        document.getElementById("txtEmp_name_sum").value=emp_name;
        document.getElementById("txtNIC_sum").value=nic;
        document.getElementById("txtTel_no_sum").value=tel_no;
        document.getElementById("txtAddress_sum").value=address;
        document.getElementById("txtBasic_salary_sum").value=basic_salary;
        document.getElementById("txtBank_sum").value=bank;
        document.getElementById("txtBranch_sum").value=branch;
        document.getElementById("txtAcc_no_sum").value=acc_no;
        document.getElementById("txtTeam_sum").value=team;
        document.getElementById("txtMarital_status_sum").value=marital_status;



    });

    $('#btnSearchAttendance').click(function () {
        var from=$('#dateFrom').val();
        var to=$('#dateTo').val();

        if (from.trim().length === 0){
            alert("Select a From Date");
            $("#dateFrom").focus();
            return;
        }


    });

//........................................................................................................

// Disable the calendar future dates
//     $("#child_dob").datepicker({ maxDate: new Date()});

//........................................................................................................

});



// $('#married').on('click', function(){
//     console.log("inside");
//     if($(this).prop('checked')){
//         console.log("true");
//         $('#marital_details').show();
//     } else {
//         console.log("false");
//         $('#marital_details').hide();
//     }
// });
// $('#married').keydown(function () {
//     var name=$('#txtEmp_nam').val();
//     console.log("employee name"+name);
//     $('#txtEmp_name_sum').val(name);
// });

