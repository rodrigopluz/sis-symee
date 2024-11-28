/**
 *	Symee Mail Script
 *
 *	Developed by Arlind Nushi - www.laborator.co
 */

var symeeMail = symeeMail || {};

;(function($, window, undefined)
{
	"use strict";
	
	$(document).ready(function()
	{
		symeeMail.$container = $(".mail-env");
		
		$.extend(symeeMail, {
			isPresent: symeeMail.$container.length > 0
		});
		
		// Mail Container Height fit with the document
		if(symeeMail.isPresent)
		{
			symeeMail.$sidebar = symeeMail.$container.find('.mail-sidebar');
			symeeMail.$body = symeeMail.$container.find('.mail-body');
			
			
			// Checkboxes
			var $cb = symeeMail.$body.find('table thead input[type="checkbox"], table tfoot input[type="checkbox"]');
			
			$cb.on('click', function()
			{
				$cb.attr('checked', this.checked).trigger('change');
				
				mail_toggle_checkbox_status(this.checked);
			});
			
			// Highlight
			symeeMail.$body.find('table tbody input[type="checkbox"]').on('change', function()
			{
				$(this).closest('tr')[this.checked ? 'addClass' : 'removeClass']('highlight');
			});
		}
	});
	
})(jQuery, window);


function fit_mail_container_height()
{
	if(symeeMail.isPresent)
	{
		if(symeeMail.$sidebar.height() < symeeMail.$body.height())
		{
			symeeMail.$sidebar.height( symeeMail.$body.height() );
		}
		else
		{
			var old_height = symeeMail.$sidebar.height();
			
			symeeMail.$sidebar.height('');
			
			if(symeeMail.$sidebar.height() < symeeMail.$body.height())
			{
				symeeMail.$sidebar.height(old_height);
			}
		}
	}
}

function reset_mail_container_height()
{
	if(symeeMail.isPresent)
	{
		symeeMail.$sidebar.height('auto');
	}
}

function mail_toggle_checkbox_status(checked)
{	
	symeeMail.$body.find('table tbody input[type="checkbox"]' + (checked ? '' : ':checked')).attr('checked',  ! checked).click();
}