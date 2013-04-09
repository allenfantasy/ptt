// Custom Javascript by Allen( dev.cna@borsch.net )
(function($){
	$(document).ready(function() {
		// Default tips on Contact Form Block 
		var contact_name = 'Your name';
		var contact_email = 'Your e-mail';
		var contact_subject = 'Subject';
		var contact_message = 'Message';
		if($('body').hasClass('i18n-de')) {
			contact_name = 'Ihr Name';
			contact_email = 'Ihre E-Mail-Adresse';
			contact_subject = 'Betreff';
			contact_message = 'Nachricht';
		}
		$('#block-contact-form-blocks-0 form input[name=name]').attr('value',contact_name);
		$('#block-contact-form-blocks-0 form input[name=mail]').attr('value',contact_email);
		$('#block-contact-form-blocks-0 form input[name=name]').blur(function() {
			if($(this).attr('value') == '') {
				$(this).attr('value', Drupal.t(contact_name))
			}
		}).click(function() {
			if($(this).attr('value') == contact_name) {
				$(this).attr('value','');
			}
		}).blur();
		$('#block-contact-form-blocks-0 form input[name=mail]').blur(function() {
			if($(this).attr('value') == '') {
				$(this).attr('value', Drupal.t(contact_email))
			}
		}).click(function() {
			if($(this).attr('value') == contact_email) {
				$(this).attr('value','');
			}
		}).blur();
		$('#block-contact-form-blocks-0 form input[name=subject]').blur(function() {
			if($(this).attr('value') == '') {
				$(this).attr('value', Drupal.t(contact_subject))
			}
		}).click(function() {
			if($(this).attr('value') == contact_subject) {
				$(this).attr('value','');
			}
		}).blur();
		$('#block-contact-form-blocks-0 form textarea[name=message]').blur(function() {
			if($(this).attr('value') == '') {
				$(this).attr('value', Drupal.t(contact_message))
			}
		}).click(function() {
			if($(this).attr('value') == contact_message) {
				$(this).attr('value','');
			}
		}).blur();
		// Restoration on Partner 
		$('.contentleft .view.ptt-restore .iframe table tr:nth-child(3) td:nth-child(1)').addClass('ptt-targeted');
		$('.contentleft .view.ptt-restore .iframe table tr:nth-child(3) td:nth-child(3)').addClass('ptt-targeted');
		// Custom the link in the country-info page
		$('.contentleft .node-country-info .content a').attr('target', '_blank');
	});
})(jQuery);
