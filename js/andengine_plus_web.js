//exports var initializeResourceUploadJS;
	/*$(function() {
		var position = $('.draggable').position();
	var $output = $('#resources');
	$output.html('<p>Left: '+position.left()+', Right: '+position.right());
	});*/

function initializeDroppable() {
	$( ".screen" ).droppable({
		  tolerance: "fit",
	      drop: function( event, ui ) {
	        $( this )
	          //.addClass( "ui-state-highlight" )
	          .append("<input type=\"text\" placeholder=\"Enter sprite name here\" class=\"text\" id=\"contact-name\" />");
	        ui.draggable.addClass("on-screen");
	      },
		  out: function( event,ui ) {
			$(this).html("");
			ui.draggable.removeClass("on-screen"); 
		  }
	    });
}
function saveSpritePosition() {
	$('.on-screen').each( function(index) {
		var image_name = $(this).attr('alt');
		var resource_name = $(this).attr('src');
		var position = $(this).position();
		$.ajax({
			url: "http://localhost/andengine_plus_web/controllers/httprouter.php?function=sprite_save",
			type: "POST",
			data: {name:image_name, resource:resource_name, position_left:position.left, position_right:position.right}
		}).done(function(html) {
			$('#results').append(html);
		});
	});
}