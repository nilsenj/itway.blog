///**
// * Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
// * For licensing, see LICENSE.md or http://ckeditor.com/license
// */
//
///* exported initSample */
//
//if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
//	CKEDITOR.tools.enableHtml5Elements( document );
//
//// The trick to keep the editor in the sample quite small
//// unless user specified own height.
//CKEDITOR.config.height = 400;
//CKEDITOR.config.width = '100%';
//CKEDITOR.config.removeDialogTabs = 'image:advanced;link:advanced';
//CKEDITOR.config.extraPlugins = ['codesnippet','autosave'];
//CKEDITOR.config.codeSnippet_theme = 'mono-blue';
//CKEDITOR.config.uiColor = 'transparent';
//CKEDITOR.config.width = '100%';
//CKEDITOR.config.resize_enabled  = true;
//CKEDITOR.config.placeholder = 'Please write your post!';
//CKEDITOR.config.skin = 'minimalist';
//CKEDITOR.config.allowedContent = true;
//
//// Remove some buttons provided by the standard plugins, which are
//// not needed in the Standard(s) toolbar.
//CKEDITOR.config.removeButtons = 'Underline,Subscript,Superscript';
//
//// Set the most common block elements.
//CKEDITOR.config.format_tags = 'p;h1;h2;h3;pre';
///**
// * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
// * For licensing, see LICENSE.md or http://ckeditor.com/license
// */
//
//CKEDITOR.editorConfig = function( config ) {
//	// Define changes to default configuration here.
//	// For complete reference see:
//	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
//
//	// The toolbar groups arrangement, optimized for two toolbar rows.
//	config.toolbarGroups = [
//		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
//		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
//		{ name: 'links' },
//		{ name: 'insert' },
//		{ name: 'forms' },
//		{ name: 'tools' },
//		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
//		{ name: 'others' },
//		'/',
//		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
//		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
//		{ name: 'styles' },
//		{ name: 'colors' },
//		{ name: 'about' }
//	];
//
//
//
//};
//var initSample = ( function() {
//	var wysiwygareaAvailable = isWysiwygareaAvailable(),
//		isBBCodeBuiltIn = !!CKEDITOR.plugins.get( 'bbcode' );
//
//	return function() {
//		var editorElement = CKEDITOR.document.getById( 'editor' );
//
//		// :(((
//		if ( isBBCodeBuiltIn ) {
//			editorElement.setHtml(
//				'Hello world!\n\n' +
//				'I\'m an instance of [url=http://ckeditor.com]CKEditor[/url].'
//			);
//		}
//
//		// Depending on the wysiwygare plugin availability initialize classic or inline editor.
//		if ( wysiwygareaAvailable ) {
//			CKEDITOR.replace( 'editor' );
//		} else {
//			editorElement.setAttribute( 'contenteditable', 'true' );
//			CKEDITOR.inline( 'editor' );
//
//			// TODO we can consider displaying some info box that
//			// without wysiwygarea the classic editor may not work.
//		}
//	};
//
//	function isWysiwygareaAvailable() {
//		// If in development mode, then the wysiwygarea must be available.
//		// Split REV into two strings so builder does not replace it :D.
//		if ( CKEDITOR.revision == ( '%RE' + 'V%' ) ) {
//			return true;
//		}
//
//		return !!CKEDITOR.plugins.get( 'wysiwygarea' );
//	}
//} )();
//
