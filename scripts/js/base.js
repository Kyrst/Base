var $overlay, $overlay_title, $overlay_message;

$(document).ready(function() {
    $overlay = $('#overlay');
    $overlay_title = $('#overlay_title');
    $overlay_message = $('#overlay_message');

    $overlay.overlay({
        load: false,
		top: 130,
        mask: {
            loadSpeed: 300,
			color: '#AAA',
            opacity: 0.3
        },
		left: 'center'
    });
});

function showOverlay(title, message) {
    $overlay_title.html(title);
    $overlay_message.html(message);
    
    $overlay.data('overlay').load();
}