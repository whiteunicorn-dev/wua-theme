(function() {
	tinymce.PluginManager.add('cols', function( editor, url ) {
		editor.addButton('cols', {
			text: '[cols]',
			onclick: function() {
				var selection = tinymce.activeEditor.selection.getContent();

				if ( selection ) {
					editor.insertContent('[cols]' + selection + '[/cols]');
				} else {
					editor.insertContent('[cols][/cols]');
				}
			}
		});
	});
})();