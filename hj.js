$(function(){

$("#err_email").hide();
$("#err_pass").hide();
$("#err_com_pass").hide();
$("#err_name").hide();
$("#err_company").hide();
$("#err_country").hide();
$("#err_state").hide();
$("#err_zip").hide();
$("#err_address").hide();
$("#err_city").hide();
$("#err_info").hide();
$("#err_phone").hide();
$("#err_mobile").hide();


var err_email=false;
var err_pass=false;
var err_com_pass=false;
var err_name=false;
var err_company=false;
var err_country=false;
var err_state=false;
var err_zip=false;
var err_address=false;
var err_city=false;
var err_info=false;
var err_phone=false;
var err_mobile=false;


$("#email").focusout(function(){
	check_email();
});

$("#pass").focusout(function(){
	check_pass();
});

$("#com_pass").focusout(function(){
	check_com_pass();
});

$("#name").focusout(function(){
	check_name();
});

$("#company").focusout(function(){
	check_company();
});

$("#country").focusout(function(){
	check_country();
});

$("#state").focusout(function(){
	check_state();
});

$("#zip").focusout(function(){
	check_zip();
});

$("#address").focusout(function(){
	check_address();
});

$("#city").focusout(function(){
	check_city();
});

$("#info").focusout(function(){
	check_info();
});

$("#phone").focusout(function(){
	check_phone();
});

$("#mobile").focusout(function(){
	check_mobile();
});

// functions to check wether is a validate user information

function check_name(){
	var name_length=$("#name").val().length;
	if(name_length <5 || name_length > 20){
		$("#err_name").html("Name should be between 5-20 letters.");
		$("#err_name").show();
		err_name=true;
	}else{
		$("#err_name").hide();
	}
}

function check_pass(){
	var name_length=$("#pass").val().length;
	if(name_length < 8){
		$("#err_pass").html("Password should be between 8-20 letters.");
		$("#err_pass").show();
		err_pass=true;
	}else{
		$("#err_pass").hide();
	}
}

function check_com_pass(){
	var pass=$("#pass").val();
	var com_pass=$("#com_pass").val();
	if(pass!=com_pass){
		$("#err_com_pass").html("Password doesn't match!");
		$("#err_com_pass").show();
		err_com_pass=true;
	}else{
		$("#err_com_pass").hide();
	}
}

function check_company(){
	var a=$("#company").val().length;
	if(a<4){
		$("#err_company").html("Enter valid company");
		$("#err_company").show();
		err_company=true;
	}else{
		$("#err_company").hide();
	}
}

function check_city(){
	var a=$("#city").val().length;
	if(a<4){
		$("#err_city").html("Enter valid city");
		$("#err_city").show();
		err_city=true;
	}else{
		$("#err_city").hide();
	}
}

function check_zip(){
	var a=$("#zip").val().length;
	if(a<5){
		$("#err_zip").html("Enter valid zip");
		$("#err_zip").show();
		err_zip=true;
	}else{
		$("#err_zip").hide();
	}
}

function check_country(){
	var a=$("#country").val().length;
	if(a<4){
		$("#err_country").html("Enter valid country");
		$("#err_country").show();
		err_country=true;
	}else{
		$("#err_country").hide();
	}
}

function check_state(){
	var a=$("#state").val().length;
	if(a<4){
		$("#err_state").html("Enter valid state");
		$("#err_state").show();
		err_state=true;
	}else{
		$("#err_state").hide();
	}
}

function check_address(){
	var a=$("#address").val().length;
	if(a<4){
		$("#err_address").html("Enter valid address");
		$("#err_address").show();
		err_address=true;
	}else{
		$("#err_address").hide();
	}
}

function check_info(){
	var a=$("#info").val().length;
	if(a<4){
		$("#err_info").html("Enter valid info");
		$("#err_info").show();
		err_info=true;
	}else{
		$("#err_info").hide();
	}
}


function check_phone() {
        var a =$("#phone").val();
        var filter =new regExp(/^[0-9-+]+$/);
        if (filter.test(a)) {
            $("#phone").hide();
        }
        else {
            $("#err_phone").html("Enter valid Number");
            $("#err_phone").show();
            err_phone=true;
        }
    }​
function check_mobile() {
        var a =$("#mobile").val();
        var filter =new regExp(/^[0-9-+]+$/);
        if (filter.test(a)) {
            $("#mobile").hide();
        }
        else {
            $("#err_mobile").html("Enter valid Number but it's optional ");
            $("#err_mobile").show();
            
        }
    }​

function check_email() {
        var a =$("#email").val();
        var filter =new regExp(/^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/);
        if (filter.test(a)) {
            $("#email").hide();
        }
        else {
            $("#err_email").html("Enter valid E-mail address");
            $("#err_email").show();
            err_email=true;
        }
    }​



});