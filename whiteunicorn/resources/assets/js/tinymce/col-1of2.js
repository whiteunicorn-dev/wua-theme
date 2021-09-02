(function() {
	tinymce.PluginManager.add('col-1of2', function( editor, url ) {
		editor.addButton('col-1of2', {
			text: '[col 1/2]',
			onclick: function() {
				var selection = tinymce.activeEditor.selection.getContent();

				if ( selection ) {
					editor.insertContent('[col width="1/2"]' + selection + '[/col]');
				} else {
					editor.insertContent('[col width="1/2"][/col]');
				}
			}
		});
	});
})();