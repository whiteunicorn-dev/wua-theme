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
    // The following example will check if there are form errors on an ajax submission. You can use the 'gform_page_loaded' event but it won't fire on form success submission
    setTimeout(() => {// use settimeout to give gforms a sec to setup contents
        if ($formCnt.find(".gform_validation_error").length) {
            $body.addClass("gform-form-errors");
            $formCnt.find("input, textarea").each(setupFocusEv); // reinit events for new form elements (gforms replaces the form after submission on errors)
        }
        else {
            $body.removeClass("gform-form-errors");
        }
    }, 500);
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



/**
 * Fires on successful submissions with AJAX
 * 
 * https://docs.gravityforms.com/gform_confirmation_loaded/
 */
$(document).on('gform_confirmation_loaded', function(event, formID) {
    // code to be triggered when the confirmation page is loaded
});


/**
 * Setup form inputs to have focus/blur events. You can use this to show/move/hide the labels when user interacts with fields
 */
function gformsFocusBlur() {
    $formCnt.find("input, textarea").each(setupFocusEv);

    function setupFocusEv(i, el) {
        const $this = $(this);

        $this.on("focus", isFocused);
        $this.on("blur", isBlurred);


        function isFocused(e) {
            $this.closest('.gfield').addClass('active');
        }
        function isBlurred(e) {
            const val = $this.val();
            if (val.length == 0 || val === '(___) ___-____') {
                $this.closest('.gfield').removeClass('active');
            }
        }
    }
}