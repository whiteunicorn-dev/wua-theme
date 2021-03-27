<?php
/**
 * Gravity Forms
 *
 * @package WhiteUnicorn
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












