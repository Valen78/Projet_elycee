/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
	config.plugins = 'dialogui,dialog,a11yhelp,basicstyles,blockquote,resize,elementspath,entities,floatingspace,panel,floatpanel,listblock,button,richcombo,format,htmlwriter,wysiwygarea,indent,indentlist,fakeobjects,link,list,magicline,maximize,removeformat,sourcearea,stylescombo,wsc,menu,menubutton,toolbar,notification,autosave,font,symbol,lineutils,clipboard,widget,mathjax,colorbutton,colordialog';

	config.language = 'fr';

	config.uiColor = '#F3872E';

	config.mathJaxLib = 'http://cdn.mathjax.org/mathjax/2.6-latest/MathJax.js?config=TeX-AMS_HTML';

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		'/',
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'tools' },
		'/',
		{ name: 'styles' },
		{ name: 'colors' }
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Anchor,Image,Table';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
