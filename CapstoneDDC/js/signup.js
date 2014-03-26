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
			},
			password1:
			{
				required: true
			},
			password2:
			{
				required: true
			}
		},
		
		messages:
		{
			email: 	 "Please enter your email address.",
			password1: "Please enter a valid password.",
			password2: "Please enter a valid password."

		},
		
		submitHandler: function(form)
		{
			$(form).ajaxSubmit(
			{
				type: "POST",
				url: "../lib/make_principal.php",
				data: $(form).serialize(),
				success: function(phpOutput)
				{
					$(signupOutput).html(phpOutput);
				}
			});
		}
	});
});