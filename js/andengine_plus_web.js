//exports var initializeResourceUploadJS;
	/*$(function() {
		var position = $('.draggable').position();
	var $output = $('#resources');
	$output.html('<p>Left: '+position.left()+', Right: '+position.right());
	});*/

function initializeDroppable() {
	$( ".screen" ).droppable({
	      drop: function( event, ui ) {
	        $( this )
	          //.addClass( "ui-state-highlight" )
	          .append("<input type=\"text\" placeholder=\"Enter sprite name here\" class=\"text\" id=\"contact-name\" />");
	        ui.draggable.addClass("on-screen");
	      }
	    });
}
function save() {
	var $onScreenElements = $(document).find(".on-screen");
}