// Gravity Forms JS hook examples
// https://docs.gravityforms.com/category/developers/hooks/javascript/

/**
 * After form render hook
 * This jQuery hook is fired every time the form is rendered to allow custom jQuery to be executed.
 * This includes initial form load, going to the next/previous page on multi-page forms, form rendered with validation errors, confirmation message displayed, etc.
 * https://docs.gravityforms.com/gform_post_render/
 */
$(document).on('gform_post_render', function(e, formID) {console.log("gform_post_render",formID);
    if (formID != 1) return; // if you only want to target specific form

    // add custom code here
});


/**
 * Fires on multi-page forms with AJAX submission enabled when changing pages (i.e. going to the next or previous page).
 * 
 * In this example getting values from first page to set value quantity field on the second page
 * https://docs.gravityforms.com/gform_page_loaded/
 */
$(document).on('gform_page_loaded', function(event, form_id, current_page) {
    if (current_page != 2) return;
    const $playersField = $("fieldset#field_2_3");
    const playersQnt = $playersField.find(".gfield_list_group").length;
    const $qntField = $("#ginput_quantity_2_5");//$("#input_2_5_1");

    $qntField.val(playersQnt);//console.log(`qnt:${playersQnt} | fieldVal: ${$qntField.val()}`);
});