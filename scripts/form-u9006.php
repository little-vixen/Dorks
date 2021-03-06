<?php 
/* 	
If you see this text in your browser, PHP is not configured correctly on this hosting provider. 
Contact your hosting provider regarding PHP configuration for your site.

PHP file generated by Adobe Muse CC 2018.0.0.379
*/

require_once('form_process.php');

$form = array(
	'subject' => 'Reports Selection Submission',
	'heading' => 'New Form Submission',
	'success_redirect' => '',
	'resources' => array(
		'checkbox_checked' => 'Selected',
		'checkbox_unchecked' => 'Unselected',
		'submitted_from' => 'Form submitted from website: %s',
		'submitted_by' => 'Visitor IP address: %s',
		'too_many_submissions' => 'Too many recent submissions from this IP',
		'failed_to_send_email' => 'Failed to send email',
		'invalid_reCAPTCHA_private_key' => 'Invalid reCAPTCHA private key.',
		'invalid_reCAPTCHA2_private_key' => 'Invalid reCAPTCHA 2.0 private key.',
		'invalid_reCAPTCHA2_server_response' => 'Invalid reCAPTCHA 2.0 server response.',
		'invalid_field_type' => 'Unknown field type \'%s\'.',
		'invalid_form_config' => 'Field \'%s\' has an invalid configuration.',
		'unknown_method' => 'Unknown server request method'
	),
	'email' => array(
		'from' => 'bthomas+ccm@adobe.com',
		'to' => 'bthomas+ccm@adobe.com'
	),
	'fields' => array(
		'custom_U9075' => array(
			'order' => 1,
			'type' => 'checkboxgroup',
			'label' => 'Tickbox Group',
			'required' => true,
			'optionItems' => array(
				'Tickbox Label',
				'Tickbox Label',
				'Tickbox Label'
			),
			'errors' => array(
				'required' => 'Field \'Tickbox Group\' is required.',
				'format' => 'Field \'Tickbox Group\' has an invalid value.'
			)
		)
	)
);

process_form($form);
?>
