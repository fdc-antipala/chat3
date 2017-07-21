(function(){
	$(document).ready(function(){
		$(".message_box").animate({ scrollTop: $('.message_box').prop("scrollHeight")}, 1000);
		var socket = io.connect( 'http://localhost:8080' );
		var ORIGIN = window.location.origin;
		var PATH = window.location.pathname;
		var BASEURL = ORIGIN + '/chat3/';

		$( "button#send" ).click( function() {
			proccessSend();
			$("input#messageInput").val('');
		});

		function proccessSend () {
			var nameVal = $('#messageForm').data().name;
			var msg = $( "#messageInput" ).val();
			if (msg == "" || msg == " ")
				return false;
			
			socket.emit( 'message', { name: nameVal, message: msg } );
			
			// Ajax call for saving datas
			$.ajax({
				url : BASEURL + 'users/insertNewMessage',
				type: "POST",
				data: { name: nameVal, message: msg },
				success: function(data) {
					
				}
			});
			$(".message_box").animate({ scrollTop: $('.message_box').prop("scrollHeight")}, 1000);
			return false;
		}

		$('#messageInput').keypress(function(e){
			if(e.which == 13) {
				proccessSend();
				$("input#messageInput").val('');
			}
		});

		socket.on( 'message', function( data ) {
			var actualContent = $( "#messages" ).html();
			var newMsgContent = '<li> <strong>' + data.name + '</strong> : ' + data.message + '</li>';
			var content = actualContent + newMsgContent;
			
			$( "#messages" ).html( content );
			$(".message_box").animate({ scrollTop: $('.message_box').prop("scrollHeight")}, 1000);
		});
	});
})();