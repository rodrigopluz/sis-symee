/**
 *	Symee Register Script
 *
 */

var symeeRegister = symeeRegister || {};

;(function($, window, undefined) {
	"use strict";
	
	$(document).ready(function() {
		symeeRegister.$container = $("#form_register");
		symeeRegister.$steps = symeeRegister.$container.find(".form-steps");
		symeeRegister.$steps_list = symeeRegister.$steps.find(".step");
		symeeRegister.step = 'step-1'; // current step
		
		
		symeeRegister.$container.validate({
			rules: {
				name: {
					required: true
				},
				
				email: {
					required: true,
					email: true
				},
				
				username: {
					required: true	
				},
				
				password: {
					required: true
				},
			},
			
			messages: {
				email: {
					email: 'Invalid E-mail.'
				}	
			},
			
			highlight: function(element){
				$(element).closest('.input-group').addClass('validate-has-error');
			},
			
			unhighlight: function(element) {
				$(element).closest('.input-group').removeClass('validate-has-error');
			},
			
			submitHandler: function(ev) {
				$(".login-page").addClass('logging-in');
				
				// We consider its 30% completed form inputs are filled
				symeeRegister.setPercentage(30, function() {
					// Lets move to 98%, meanwhile ajax data are sending and processing
					symeeRegister.setPercentage(98, function() {
						// Send data to the server
						$.ajax({
							url: baseurl + 'data/sample-register-form.php',
							method: 'POST',
							dataType: 'json',
							data: {
								name: 		$("input#name").val(),
								phone: 		$("input#phone").val(),
								birthdate: 	$("input#birthdate").val(),
								username: 	$("input#username").val(),
								email: 		$("input#email").val(),
								password:	$("input#password").val()
							},
							error: function() {
								alert("An error occoured!");
							},
							success: function(response) {
								// From response you can fetch the data object retured
								var name = response.submitted_data.name,
									phone = response.submitted_data.phone,
									birthdate = response.submitted_data.birthdate,
									username = response.submitted_data.username,
									email = response.submitted_data.email,
									password = response.submitted_data.password;
								
								// Form is fully completed, we update the percentage
								symeeRegister.setPercentage(100);
								
								// We will give some time for the animation to finish, then execute the following procedures	
								setTimeout(function() {
									// Hide the description title
									$(".login-page .login-header .description").slideUp();
									
									// Hide the register form (steps)
									symeeRegister.$steps.slideUp('normal', function() {
										// Remove loging-in state
										$(".login-page").removeClass('logging-in');
										
										// Now we show the success message
										$(".form-register-success").slideDown('normal');
										
										// You can use the data returned from response variable
									});
								}, 1000);
							}
						});
					});
				});
			}
		});
	
		// Steps Handler
		symeeRegister.$steps.find('[data-step]').on('click', function(ev) {
			ev.preventDefault();
			
			var $current_step = symeeRegister.$steps_list.filter('.current'),
				next_step = $(this).data('step'),
				validator = symeeRegister.$container.data('validator'),
				errors = 0;
			
			symeeRegister.$container.valid();
			errors = validator.numberOfInvalids();
			
			if (errors) {
				validator.focusInvalid();
			}
			else {
				var $next_step = symeeRegister.$steps_list.filter('#' + next_step),
					$other_steps = symeeRegister.$steps_list.not( $next_step ),
					
					current_step_height = $current_step.data('height'),
					next_step_height = $next_step.data('height');
				
				TweenMax.set(symeeRegister.$steps, {css: {height: current_step_height}});
				TweenMax.to(symeeRegister.$steps, 0.6, {css: {height: next_step_height}});
				
				TweenMax.to($current_step, .3, {css: {autoAlpha: 0}, onComplete: function() {
					$current_step.attr('style', '').removeClass('current');
					
					var $form_elements = $next_step.find('.form-group');
					
					TweenMax.set($form_elements, {css: {autoAlpha: 0}});
					$next_step.addClass('current');
					
					$form_elements.each(function(i, el) {
						var $form_element = $(el);
						
						TweenMax.to($form_element, .2, {css: {autoAlpha: 1}, delay: i * .09});
					});
					
					setTimeout(function() {
						$form_elements.add($next_step).add($next_step).attr('style', '');
						$form_elements.first().find('input').focus();
						
					}, 1000 * (.5 + ($form_elements.length - 1) * .09));
				}});
			}
		});
		
		symeeRegister.$steps_list.each(function(i, el) {
			var $this = $(el),
				is_current = $this.hasClass('current'),
				margin = 20;
			
			if (is_current) {
				$this.data('height', $this.outerHeight() + margin);
			}
			else {
				$this.addClass('current').data('height', $this.outerHeight() + margin).removeClass('current');
			}
		});
		
		// Login Form Setup
		symeeRegister.$body = $(".login-page");
		symeeRegister.$login_progressbar_indicator = $(".login-progressbar-indicator h3");
		symeeRegister.$login_progressbar = symeeRegister.$body.find(".login-progressbar div");
		
		symeeRegister.$login_progressbar_indicator.html('0%');
		
		if (symeeRegister.$body.hasClass('login-form-fall')) {
			var focus_set = false;
			
			setTimeout(function(){ 
				symeeRegister.$body.addClass('login-form-fall-init')
				
				setTimeout(function() {
					if ( !focus_set) {
						symeeRegister.$container.find('input:first').focus();
						focus_set = true;
					}
				}, 550);
			}, 0);
		}
		else {
			symeeRegister.$container.find('input:first').focus();
		}
		
		// Functions
		$.extend(symeeRegister, {
			setPercentage: function(pct, callback) {
				pct = parseInt(pct / 100 * 100, 10) + '%';
				
				// Normal Login
				symeeRegister.$login_progressbar_indicator.html(pct);
				symeeRegister.$login_progressbar.width(pct);
				
				var o = {
					pct: parseInt(symeeRegister.$login_progressbar.width() / symeeRegister.$login_progressbar.parent().width() * 100, 10)
				};
				
				TweenMax.to(o, .7, {
					pct: parseInt(pct, 10),
					roundProps: ["pct"],
					ease: Sine.easeOut,
					onUpdate: function() {
						symeeRegister.$login_progressbar_indicator.html(o.pct + '%');
					},
					onComplete: callback
				});
			}
		});
	});
})(jQuery, window);