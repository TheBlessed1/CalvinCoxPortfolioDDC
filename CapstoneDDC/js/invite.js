$(document).ready(function()
{
	// establish Ids of commonly used items
	var formId   = "#signupForm";
	var outputId = "#signupOutput";
	
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
			}
		},
		
		messages:
		{
			email: 	    "Please enter your email address."

		},
		
		submitHandler: function(form)
		{
			$(form).ajaxSubmit(
			{
				type: "POST",
				url: "../lib/user_invite.php",
				data: $(form).serialize(),
				success: function(phpOutput)
				{
					$(signupOutput).html(phpOutput);
				}
			});
		}
	});
});