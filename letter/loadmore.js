(function($) {

	$.fn.scrollPagination = function(options) {
		
		var settings = { 
			nop     : 10, // The number of posts per scroll to be loaded
			offset  : 0, // Initial offset, begins at 0 in this case
			error   : 'No More Posts!', // When the user reaches the end this is the message that is
			                            // displayed. You can change this if you want.
			delay   : 0, // When you scroll down the posts will load after a delayed amount of time.
			               // This is mainly for usability concerns. You can alter this as you see fit
			scroll  : true // The main bit, if set to false posts will not load as the user scrolls. 
			               // but will still load if the user clicks.
		}
		
		// Extend the options so they work with the plugin
		if(options) {
			$.extend(settings, options);
		}
		
		// For each so that we keep chainability.
		return this.each(function() {		
			
			// Some variables 
			$this = $(this);
			$settings = settings;
			var offset = $settings.offset;
			var busy = false; // Checks if the scroll action is happening 
			                  // so we don't run it multiple times
			
			// Custom messages based on settings
			if($settings.scroll == true) $initmessage = '';
			else $initmessage = '';
			
			// Append custom messages and extra UI
			/*$this.append('<div class="content"></div><div class="loading-bar">'+$initmessage+'</div>');*/
			
			function getData() {
				pagerightnow++;
				$('#mainpage').append("<div id=moreloading><img src=icon/preloader.gif></div>");

				// Post data to lettermore.php
				$.post('letter/lettermore.php', {
					group : sendto,	
					page : pagerightnow,
					action        : 'scrollpagination',
				    number        : $settings.nop,
				    offset        : offset,
					    
				}, function(data) {
						
					// Change loading bar content (it may have been altered)
					
						
					// If there is no data returned, there are no more posts to be shown. Show error
					if(data.length < 30) { 
					$('#morebtn').remove();
					$('#mainpage').append("<div id=morebtn>마지막페이지입니다.</div>");
					$('#moreloading').remove();
					busy = false;
					}
					else {
						
						// Offset increases
					    offset = offset+$settings.nop; 
						    
						// Append the data to the content div
					   	/*$this.find('.content').append(data);*/
						
					
						$('#mainpage').append(data);
					$('#morebtn').remove();
					$('#moreloading').remove();
					$('#mainpage').append("<div id=morebtn style='cursor:hand' onclick='ajaxMore();'>더보기</div>");

						// No longer busy!	
						busy = false;
					}	
						
				});
					
			}	
			
			getData(); // Run function initially
			
			// If scrolling is enabled
			if($settings.scroll == true) {
				// .. and the user is scrolling
				$(window).scroll(function() {
					
					// Check the user is at the bottom of the element
					if($(window).scrollTop() + windowheight + 200 > $this.height() && !busy) {

						// Now we are working, so busy is true
						busy = true;
						
						// Tell the user we're loading posts
						
						
						// Run the function to fetch the data inside a delay
						// This is useful if you have content in a footer you
						// want the user to see.
						setTimeout(function() {
							
							getData();
							
						}, $settings.delay);
							
					}	
				});
			}
			
			// Also content can be loaded by clicking the loading bar/
			$this.find('.loading-bar').click(function() {
			
				if(busy == false) {
					busy = true;
					getData();
				}
			
			});
			
		});
	}

})(jQuery);
