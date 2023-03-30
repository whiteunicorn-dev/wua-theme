<?php
/**
 * Gravity Forms
 *
 * @package WhiteUnicorn
 * https://docs.gravityforms.com/category/developers/hooks/
 */


/**
* Render Gravity Form
*
* @param {integer || string} $form : The id or title of the form to be embedded. DEFAULT 1 (first form)
* @param {boolean} $ajax : Use AJAX or not. DEFAULT true
* @param {array} $fieldValues : Pass an array of dynamic population parameter keys with their corresponding values to be populated. Ex: “array(‘parameter_name’ => ‘custom_value’)”
* @return {string} Echo's out the form
*/
function render_gform( $form = 1, $ajax = true, $fieldValues = '' ) {
	return gravity_form( $form, false, false, false, $fieldValues, $ajax );
}


/**
 * Set the value of a field before it's rendered
 * NOTE: To set value of field you must check "Allow field to be populated dynamically" on the backend and then enter a parameter name.
 */
function set_field_value_function( $value ) {
    $newValue = strtolower( get_the_title() );

    return $newValue;
}
//add_filter( 'gform_field_value_PARAMETER-NAME', 'set_field_value_function' );


/**
 * Set notification email recipient with custom fields
 * NOTE: In this example, if no email is set, will send to admin email
 */
function custom_notification_routing( $notification, $form, $entry ) {
    $recipient_email = get_field('header_cta')['email_recipient'];
	
	if ( !$recipient_email ) { return $notification; }
	
	if ( $notification['name'] == 'Admin Notification' ) {
        $notification['toType'] = 'email';
		$notification['to'] = $recipient_email;
    }
 
    return $notification;
}
//add_filter( 'gform_notification_3', 'custom_notification_routing', 10, 3 );
// Note: gform_notification_1 will target the gravity form with the ID of 1. Change as needed


/**
 * Add options to a dropdown/radio/etc field dynamically
 * NOTE: In this example it's populating a dropdown field with a list of communities.
 */
function populate_select_field( $form ) {
	foreach( $form['fields'] as &$field )  {/*Note: using &$field allows you to change the value of the item in the loop.*/
        $field_id = 9; // the field id you want to target
        if ( $field->id != $field_id ) {
            continue;
        }
		$currentTitle = get_the_title();
        $communities = array( "Community 1", "Community 2", "Community 3", "Community 4", "Community 5" ); // you can use custom fields to get a list or do a query to get post titles, etc.
        $options = array();

        foreach ( $communities as $community ) {
        	$isSelected = ( $currentTitle == $community ) ? 1 : 0;
			// NOTE: theres a bug with the isSelected option, had to use JS to have a certain option selected when the page loads
        	$options[] = array( 'text' => $community, 'value' => sanitize_title( $community ), 'isSelected' => $isSelected );
        }

        $field->choices = $options;
        $field->isRequired = true;
    }

    return $form;
}
//add_filter( 'gform_pre_render_4', 'populate_select_field');
//add_filter( 'gform_pre_validation_4', 'populate_select_field' );
// Note: gform_pre_render_4 will target the gravity form with the ID of 4. Change as needed. Use both gform_pre_render && gform_pre_validation hooks


/**
 * Dynamic redirect url
 */
function custom_confirmation_redirect( $confirmation, $form, $entry, $ajax ) {
	$redirect_url = "//website.com/thank-you";

	// If you want to pass data to the redirect page with values from the submitted form
	$recipientName = ( $entry[8] ) ? rgar( $entry, '8' ) : false; // use field id of value you want to get
	$redirect_url .= ( $recipientName ) ? '?name=' . $recipientName : '';

    $confirmation = array( 'redirect' => $redirect_url );

    return $confirmation;
}
//add_filter( 'gform_confirmation_7', 'custom_confirmation_redirect', 10, 4 );
// Note: gform_notification_7 will target the gravity form with the ID of 7. Change as needed


/**
 * Dynamic confirmation message
 */
function custom_confirmation_message( $confirmation, $form, $entry, $ajax ) {
	if ( $form['id'] == '4' or $form['id'] == '6' ) {
		$recipientName = ( $entry[8] ) ? rgar( $entry, '8' ) : false;
		if ( $recipientName != false ) {
			$confirmation = "Thank you $recipientName for your inquiry. We'll be reaching out to you soon.";
		}
	}

    return $confirmation;
}
//add_filter( 'gform_confirmation', 'custom_confirmation_message', 10, 4 );
// Note: In this example it will target all forms. You can use the form id to target specific forms or use "gform_confirmation_FORM-ID"




