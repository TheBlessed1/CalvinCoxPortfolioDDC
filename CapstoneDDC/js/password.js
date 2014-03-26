$(document).ready(function()
{
	// establish Ids of commonly used items
	var formId   = "#changePassword";
	var outputId = "#changePasswordOutput";
	
	// clear the status message when the user clears the form
	$(formId).bind("reset", function()
	{
		$(outputId).empty();
		$(outputId).removeClass();
		$(formId).reset();
	});
	
	// validate the form
	$(formId).validate(
	{
		rules:
		{
			email:
			{
				required: true
			},
			oldPassword:
			{
				required: true
			},
			newPassword1:
			{
				required: true
			},
			newPassword2:
			{
				required: true
			}
		},
		
		messages:
		{
			email: 	    "Please enter your email address.",
			oldPassword:  "Please enter a valid password.",
			newPassword1: "Please enter a valid password.",
			newPassword2: "Please enter a valid password."

		},
		
		submitHandler: function(form)
		{
			$(form).ajaxSubmit(
			{
				type: "POST",
				url: "../lib/change_password.php",
				data: $(form).serialize(),
				success: function(phpOutput)
				{
					$(changePasswordOutput).html(phpOutput);
				}
			});
		}
	});
});