(function(){
	$(document).ready(function(){
		var socket = io.connect( 'http://localhost:8080' );
		var ORIGIN = window.location.origin;
		var PATH = window.location.pathname;
		var BASEURL = ORIGIN + '/chat3/';

		$( "#messageForm" ).submit( function() {
			
			var nameVal = $( "#nameInput" ).val();
			var msg = $( "#messageInput" ).val();
			
			socket.emit( 'message', { name: nameVal, message: msg } );
			
			// Ajax call for saving datas
			$.ajax({
				url : BASEURL + 'users/insertNewMessage',
				type: "POST",
				data: { name: nameVal, message: msg },
				success: function(data) {
					
				}
			});
			
			return false;
		});

		socket.on( 'message', function( data ) {
			var actualContent = $( "#messages" ).html();
			var newMsgContent = '<li> <strong>' + data.name + '</strong> : ' + data.message + '</li>';
			var content = actualContent + newMsgContent;
			
			$( "#messages" ).html( content );
		});
	});
})();