/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here. For example:
    // config.language = 'fr';
    // config.uiColor = '#AADC6E';

    config.skin = 'office2013';
    config.allowedContent = true;
    config.autoParagraph = false;

    var custom_path = site_path + '/public/plugins/';
    config.filebrowserBrowseUrl = custom_path + 'filemanager/dialog.php?type=2&editor=ckeditor&akey=f082bb76e751504cec75782056627a84&fldr=';
    config.filebrowserUploadUrl = custom_path + 'filemanager/dialog.php?type=2&editor=ckeditor&akey=f082bb76e751504cec75782056627a84&fldr=';
    config.filebrowserImageBrowseUrl = custom_path + 'filemanager/dialog.php?type=1&editor=ckeditor&akey=f082bb76e751504cec75782056627a84&fldr=';
};

CKEDITOR.dtd.$removeEmpty.i = 0;
CKEDITOR.dtd.$removeEmpty.span = 0;
