/**
 *	Symee Notes Script
 *
 */

var symeeNotes = symeeNotes || {};

;(function($, window, undefined) {
	"use strict";
	
	$(document).ready(function() {
		symeeNotes.$container = $(".notes-env");
		
		$.extend(symeeNotes, {
			isPresent: symeeNotes.$container.length > 0,
			
			noTitleText: "Untitled",
			noDescriptionText: "(No content)",
			
			
			$currentNote: $(null),
			$currentNoteTitle: $(null),
			$currentNoteDescription: $(null),
			$currentNoteContent: $(null),
			
			addNote: function() {
				var $note = $('<li><a href="#"><strong></strong><span></li></a></li>');
				
				$note.append('<div class="content"></div>').append('<button class="note-close">&times;</button>');
				
				$note.find('strong').html(symeeNotes.noTitleText);
				$note.find('span').html(symeeNotes.noDescriptionText);
				
				symeeNotes.$notesList.prepend($note);
				
				TweenMax.set($note, {autoAlpha: 0});
				
				var tl = new TimelineMax();
				
				tl.append( TweenMax.to($note, .10, {css: {autoAlpha: 1}}) );
				tl.append( TweenMax.to($note, .15, {css: {autoAlpha: .8}}) );
				tl.append( TweenMax.to($note, .15, {css: {autoAlpha: 1}}) );
				
				symeeNotes.$notesList.find('li').removeClass('current');
				$note.addClass('current');
				
				symeeNotes.$writePadTxt.focus();
				
				symeeNotes.checkCurrentNote();
			},
			
			checkCurrentNote: function() {
				var $current_note = symeeNotes.$notesList.find('li.current').first();
				
				if ($current_note.length) {
					symeeNotes.$currentNote             = $current_note;
					symeeNotes.$currentNoteTitle        = $current_note.find('strong');
					symeeNotes.$currentNoteDescription  = $current_note.find('span');
					symeeNotes.$currentNoteContent      = $current_note.find('.content');
					
					symeeNotes.$writePadTxt.val( $.trim( symeeNotes.$currentNoteContent.html() ) ).trigger('autosize.resize');;
				}
				else {
					var first = symeeNotes.$notesList.find('li:first:not(.no-notes)');
					
					if (first.length) {
						first.addClass('current');
						symeeNotes.checkCurrentNote();
					}
					else {
						symeeNotes.$writePadTxt.val('');
						symeeNotes.$currentNote = $(null);
						symeeNotes.$currentNoteTitle = $(null);
						symeeNotes.$currentNoteDescription = $(null);
						symeeNotes.$currentNoteContent = $(null);
					}
				}
			},
			
			updateCurrentNoteText: function() {
				var text = $.trim( symeeNotes.$writePadTxt.val() );
					
				if (symeeNotes.$currentNote.length) {
					var title = '',
						description = '';
					
					if (text.length) {
						var _text = text.split("\n"), currline = 1;
						
						for (var i=0; i<_text.length; i++) {
							if (_text[i]) {
								if (currline == 1) {
									title = _text[i];
								}
								else if (currline == 2) {
									description = _text[i];
								}
								
								currline++;
							}
							
							if (currline > 2)
								break;
						}
					}
					
					symeeNotes.$currentNoteTitle.text( title.length ? title : symeeNotes.noTitleText );
					symeeNotes.$currentNoteDescription.text( description.length ? description : symeeNotes.noDescriptionText );
					symeeNotes.$currentNoteContent.text( text );
				}
				else if (text.length) {
					symeeNotes.addNote();
				}
			}
		});
		
		// Mail Container Height fit with the document
		if (symeeNotes.isPresent) {
			symeeNotes.$notesList = symeeNotes.$container.find('.list-of-notes');
			symeeNotes.$writePad = symeeNotes.$container.find('.write-pad');
			symeeNotes.$writePadTxt = symeeNotes.$writePad.find('textarea');
			
			symeeNotes.$addNote = symeeNotes.$container.find('#add-note');
			
			symeeNotes.$addNote.on('click', function(ev) {
				symeeNotes.addNote();
			});
			
			symeeNotes.$writePadTxt.on('keyup', function(ev) {
				symeeNotes.updateCurrentNoteText();
			});
			
			symeeNotes.checkCurrentNote();
			
			symeeNotes.$notesList.on('click', 'li a', function(ev) {
				ev.preventDefault();
				
				symeeNotes.$notesList.find('li').removeClass('current');
				$(this).parent().addClass('current');
				
				symeeNotes.checkCurrentNote();
			});
			
			symeeNotes.$notesList.on('click', 'li .note-close', function(ev) {
				ev.preventDefault();
				
				var $note = $(this).parent();
				
				var tl = new TimelineMax();
				
				tl.append( 
					TweenMax.to($note, .15, {css: {autoAlpha: 0.2}, onComplete: function() {
						$note.slideUp('fast', function() {
							$note.remove();
							symeeNotes.checkCurrentNote();
						});
					}}) 
				);
			});
		}
	});
})(jQuery, window);

