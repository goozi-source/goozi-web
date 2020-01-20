$(document).ready(function()
{
	if (screen.width >= 768.1) 
	{
		$("#mobile-view").remove()
		var form = document.getElementById("mobileForm");
		var elements = form.elements;
		for (var i = 0, len = elements.length; i < len; ++i) {
		    elements[i].readOnly = true;
		}
		$('#wpassword, #wcpassword').on('keyup', function () 
		{
		    if ($('#wpassword').val() == $('#wcpassword').val()) {
		        $('#wmessage').html('<i class="fas fa-check-circle"></i> Passwords Match').css('color', 'green')
		    } 
		    else {
		        $('#wmessage').html('<i class="fas fa-times-circle"></i> Passwords do not match').css('color', 'red')
		    }
		})
	}
	else if (screen.width <= 768)
	{
		$("#web-view").remove()
		var form = document.getElementById("webForm");
		var elements = form.elements;
		for (var i = 0, len = elements.length; i < len; ++i) {
		    elements[i].readOnly = true;
		}
		
		$('#password, #cpassword').on('keyup', function () 
		{
		    if ($('#password').val() == $('#cpassword').val()) {
		        $('#message').html('<i class="fas fa-check-circle"></i> Passwords Match').css('color', 'green')
		    } 
		    else {
		        $('#message').html('<i class="fas fa-times-circle"></i> Passwords do not match').css('color', 'red')
		    }
		})
	}
})






