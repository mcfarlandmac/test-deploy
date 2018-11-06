(function() {
  tinymce.create('tinymce.plugins.code', {
    init : function(editor, url) {
      editor.addButton('easy_image_gallery', {
        title : 'Insert Gallery',
        cmd : 'easy_image_gallery',
        image :  url + '/../images/gallery.png'
      });
      editor.addCommand('easy_image_gallery', function() {
        editor.execCommand('mceInsertContent', 0, '[easy_image_gallery]');
      });
    }
  });
  // Register plugin
  tinymce.PluginManager.add( 'easy_image_gallery', tinymce.plugins.code );
})();