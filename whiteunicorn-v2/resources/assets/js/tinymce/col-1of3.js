(function() {
	tinymce.PluginManager.add('col-1of3', function( editor, url ) {
		editor.addButton('col-1of3', {
			text: '[col 1/3]',
			onclick: function() {
				var selection = tinymce.activeEditor.selection.getContent();

				if ( selection ) {
					editor.insertContent('[col width="1/3"]' + selection + '[/col]');
				} else {
					editor.insertContent('[col width="1/3"][/col]');
				}
			}
		});
	});
})();