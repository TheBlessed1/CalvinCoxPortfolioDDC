$(document).ready(function()
{
	// establish Ids of commonly used items
	var formId   = "#prefForm";
	var outputId = "#prefOutput";
	
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
		submitHandler: function(form)
		{
			$(form).ajaxSubmit(
			{
				type: "POST",
				url: "../lib/pref_controller.php",
				data: $(form).serialize(),
				success: function(phpOutput)
				{
					$(outputId).html(phpOutput);
				}
			});
		}
	});
});