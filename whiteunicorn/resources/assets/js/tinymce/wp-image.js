(function() {
	tinymce.PluginManager.add('wp-image', function( editor, url ) {//console.log("EDITOR", editor);
		editor.addButton('wp-image', {
			text: '[wp-image]',
			onclick: function() {
				//var selection = tinymce.activeEditor.selection.getContent(); //use if needed (if user has content selected in the wysiwyg editor)
				editor.windowManager.open( {
                    title: 'WP Image',
                    body: [
                        {
                            //label: 'Image',
                            type: 'textbox',
                            name: 'wp_img_url',//e.data.wp_img_url
                            value: '',
                            classes: 'wp-img-url',//Note: classes will have "mce-" prepended to them. Ex: mce-wp-img-url
                        },
						{
							label: "Image ID",
							type: "textbox",
							name: 'wp_img_id',//e.data.wp_img_id
							value: '',
							classes: 'wp-img-id',
						},
                        {
                            type: 'button',
                            name: 'wp_upload_btn',
                            label: '',
                            text: 'Click to select image',
                            classes: 'wp-img-upload-btn',
                        },
                    ],
                    onsubmit: function( e ) {
                        editor.insertContent('[wp-img]');//Using attributes with shortcode was causing issues with the wysiwyg Visual Editor after updating page for some reason
						editor.insertContent('<!-- {{' + e.data.wp_img_id + '}} -->');//In turn I hid the attributes and use "getSubstring()" to get attributes in the shortcode function
                        editor.insertContent('<img src="' + e.data.wp_img_url + '" />');//Display an image in the wysiwyg for visualization but in the shortcode function replace content with wp_get_attachment()
						editor.insertContent('[/wp-img]');
                        //console.log("INSERT MEDIA DATA", e.data);
                    },
					onOpen: function(e) {
						
					},
                });
			}
		});
																		
	});

})();

jQuery(document).ready(function($){
    $(document).on('click', '.mce-wp-img-upload-btn', upload_wpImg_tinymce);

    function upload_wpImg_tinymce(e) {
        e.preventDefault();
        var $imgUrlField = $('.mce-wp-img-url');//Note: input fields will have "mce-" prepended to them
		var $imgIdField = $('.mce-wp-img-id');
        var custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Add Image',
            button: {
                text: 'Add Image'
            },
            multiple: false
        });
        custom_uploader.on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
			//console.log("MEDIA ATTACHMENT", attachment);
            $imgUrlField.val(attachment.url);
			$imgIdField.val(attachment.id);
        });
        custom_uploader.open();
    }
});













