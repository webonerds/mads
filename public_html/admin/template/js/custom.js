/**
 * @file       custom.js
 * @created    09/10/2013 05:25:49 PM
 * @package    FansUnite
 * @copyright  Copyright (C) 2014
 * @license    Proprietary
 * @author     Gagandeep Gambhir
 */
$(document).ready(function(){
	
    //Handles preview image on fancybox when we edit a record
    $('.previewImage, .fancybox').live('mousedown', function(e){
		
		$(this).fancybox();
		e.preventDefault();
	});
    
    //Handles delete image
    $('.deleteImage').click(function(e){
           e.preventDefault();
		   var $button = $(this);
		   
		   $.confirm('Do you really want to delete the image?'
			, function(){
				$.post($button.data('url') + "&ajax=1&id=" + $button.data('record-id') + "&field=" + $button.data('field')
						, {}
						, function(data){
							if (data.success == 1)
							{
								$button.hide();
								$button.parents('div').find('a.previewImage').hide();
								$.alert('Image deleted successfully');
								
							}
							else
							{
								$.alert('Error deleting the image');
							}
						}
					)
					.fail(function(jqXHR, textStatus, errorThrown){
						alert(jqXHR.responseText);
					});
			});	
    });
		
		
	//Toggle status on click of icon in active column - requires icon class 'toggleActive'
	$(".toggleActive").live('click', function(e){
		e.preventDefault();
		var obj = $(this);
		$.confirm('Do you really want to toggle the status?', function(){			
			$.post($(obj).attr('href'), function(data){
					if(data.success)
					{
						if (data.active)
							$(obj).removeClass('i_cross').addClass('i_tick');
						else
							$(obj).removeClass('i_tick').addClass('i_cross');
					
							$.alert('Updated successfully.');
					}
			})
			.fail(function(jqXHR, textStatus, errorThrown){
				alert(jqXHR.responseText);
			});
			
		});
		return false;
	});	
		
});


function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/[^\w ]+/g,'')
        .replace(/ +/g,'-')
        ;
}
