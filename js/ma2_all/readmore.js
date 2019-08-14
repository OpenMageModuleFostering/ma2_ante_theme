jQuery.noConflict();

jQuery(function ($) {

	// Grab all the excerpt class
	$('.excerpt').each(function () {
	
		// Run formatWord function and specify the length of words display to viewer
		$(this).html(formatWords($(this).html(), 30));
		
		// Hide the extra words
		$(this).children('span').hide();
	
	// Apply click event to read more link
	}).click(function () {

		// Grab the hidden span and anchor
		var more_text = $(this).children('span.more_text');
		var more_link = $(this).children('a.more_link');
			
		// Toggle visibility using hasClass
		// I know you can use is(':visible') but it doesn't work in IE8 somehow...
		if (more_text.hasClass('hide')) {
			more_text.show();
			more_link.html(' &raquo; hide');		
			more_text.removeClass('hide');
		} else {
			more_text.hide();
			more_link.html(' &laquo; more');			
			more_text.addClass('hide');
		}

		return false;
	
	});
});

	// Accept a paragraph and return a formatted paragraph with additional html tags
	function formatWords(sentence, show) {

		// split all the words and store it in an array
		var words = sentence.split(' ');
		var new_sentence = '';

		// loop through each word
		for (i = 0; i < words.length; i++) {
	
			// process words that will visible to viewer
			if (i <= show) {
				new_sentence += words[i] + ' ';
				
			// process the rest of the words
			} else {
		
				// add a span at start
				if (i == (show + 1)) new_sentence += '... <span class="more_text hide">';		

				new_sentence += words[i] + ' ';
			
				// close the span tag and add read more link in the very end
				if (words[i+1] == null) new_sentence += '</span><a href="#" class="more_link"> &raquo; more</a>';
			} 		
		} 
	
		return new_sentence;

	}	
    