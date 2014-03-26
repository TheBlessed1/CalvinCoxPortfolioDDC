$(document).ready(function()
{
	// establish Ids of commonly used items
	var formId   = "#password";
	var outputId = "#passwordOutput";
	
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
			password:
			{
				required: true
			}
		},
		
		messages:
		{
			email: 	 "Please enter your email address.",
			password:  "Please enter a valid password."

		},
		
		submitHandler: function(form)
		{
			$(form).ajaxSubmit(
			{
				type: "POST",
				url: "../lib/user_login.php",
				data: $(form).serialize(),
				success: function(phpOutput)
				{
					$(passwordOutput).html(phpOutput);
				}
			});
		}
	});
});