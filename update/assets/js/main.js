(function ($) {
	"use strict";
// ajax form submit after click button
$(function(){ 
	$(document).on('click','#form-submit',function(e){
		if(!check_empty_field() || !validateEmail($('#email').val()))
		{
			submitMSG(false, "The form is not fill up properly. Please Check the RED marked field.");
		}else{
			var url = $('#installForm').attr('action'); // get action url from form action 
			var base_url =   $('#base_url').val();
			var formData = new FormData($('#installForm')[0]);
		    $.ajax({
				url: url,
				type: 'post',
				dataType: "json",
				data:formData,
		        cache:false,
		        contentType: false,
		        processData: false,
				contentType: false,
				beforeSend:function(){
				  $('#form-submit').attr('disabled', 'disabled');
				  $('.button_area').slideUp();
				  $('.install_area').slideDown();
				},
				success: function(data,error){
					if(data.st==1){
						$('#installForm')[0].reset();
						$('#form-submit').attr('disabled', false);
						$('.install_area').slideUp();
						submitMSG(true,'Install completed successfuly');
						setTimeout(function(){ window.location.href = base_url+'login'; }, 2000);
						
						
					}else{
						submitMSG(false, data.msg);
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(xhr.status);
				}


			});
		}
	});

});








// check email format validation
$(document).on('input','#email',function(){
	var valid = true;
	var email = $(this).val();
	if(!validateEmail(email)){
		submitMSG(false, "Sorry Your Email is not in correct format");
		$(this).addClass('invalid');
		valid = false;
	}else{
		submitMSG(false, "");
		$("#msgSubmit").removeClass();
		$(this).removeClass('invalid');

	}
	return valid;
});



// check all empty fields with required attribute
function check_empty_field(){
	var valid = true;
	$('input, select, textarea').each(function(){
	   if($(this).val()=="" && $(this).prop('required')){
	   		$(this).addClass('invalid');
	   		if($(this).attr('id')=="uploaded_img"){
	   			$('.up_user_img').addClass('invalid');
	   		}
	      	valid = false;
	    }
	});

	return valid;
}


//email validation function
function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

// default msg function
function submitMSG(valid, msg){
    if(valid){
        var alertClasses = "h3 text-center fadeInDown animated text-success easy_error_msg";
    } else {
        var alertClasses = "h3 text-center fadeInUp animated text-danger easy_error_msg";
    }
    $("#msgSubmit").removeClass().addClass(alertClasses).text(msg);

}


}(jQuery));	

 