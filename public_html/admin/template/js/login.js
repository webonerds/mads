$(document).ready(function() {
						   
						   
	var $body = $('body'),
		$content = $('#content'),
		$form = $content.find('#login-form'),
		$forgotform = $content.find('#forgot-form');
	
		
		//IE doen't like that fadein
		if(!$.browser.msie) $body.fadeTo(0,0.0).delay(500).fadeTo(1000, 1);
		
		
		$("input").uniform();
		

		$form.wl_Form({
			status:false,
			ajax:false,
			submitbutton:$('button.submit'),
			onBeforeSubmit: function(data){
				$form.wl_Form('set','sent',false);
				if($('#LoginForm_username').val() != "" && $('#LoginForm_password').val() != "")
				{
					return true;
				}
				else
				{
					$.wl_Alert('Please provide something!','info','#content');
					return false;
				}
			}							  
		});	
		
		$forgotform.wl_Form({
			status:false,
			ajax:false,
			submitbutton:$('button.submit'),
			onBeforeSubmit: function(data){
				
				$forgotform.wl_Form('set','sent',false);
				if($('#ForgotpasswordForm_username').val() != "")
				{
					return true;
				}
				else
				{
					$.wl_Alert('Please provide something!','info','#content');
					return false;
				}
			}							  
		});	
});