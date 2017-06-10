$(function(){
	$('#resetbtn').click(function(){
		$(this).blur();
		$(this).closest('form').validate().resetForm();
		$(this).closest('form').removeClass('has-error');
	});

	$('#stateForm').validate({
		errorElement:'span',
		errorClass:'error',
		rules:
		{
			state:
			{
				required: true
			}
		},
		messages:
		{
			state:
			{
				required:'Please Enter State'
			}
		},
		highlight:function(element,errorClass)
		{
			$(element).addClass('has-error');
		},
		unhighlight:function(element,errorClass)
		{
			$(element).removeClass('has-error');
		}
	});
});