(function(){
	$(document).ready(function(){
		var nameVal = $('.bottom_wrapper').data().name;
		var userID = $('.bottom_wrapper').data().id;
		console.log(userID);

		$(".messages").animate({ scrollTop: $('.messages').prop("scrollHeight")}, 1000);
		var socket = io.connect( 'http://localhost:8080' );
		var ORIGIN = window.location.origin;
		var PATH = window.location.pathname;
		var BASEURL = ORIGIN + '/chat3/';

		$( "#send" ).click( function() {
			proccessSend();
			$("input#messageInput").val('');
		});

		function proccessSend () {
			
			var msg = $( "#messageInput" ).val();
			if (msg == "" || msg == " ")
				return false;
			
			socket.emit( 'message', { name: nameVal, message: msg, from_id: userID } );
			
			// Ajax call for saving datas
			$.ajax({
				url : BASEURL + 'chats/insertNewMessage',
				type: "POST",
				data: { 
					name: nameVal,
					message: msg,
					from_id: userID
				},
				success: function(data) {
					
				}
			});
			$(".messages").animate({ scrollTop: $('.messages').prop("scrollHeight")}, 1000);
			return false;
		}

		$('#messageInput').keypress(function(e){
			if(e.which == 13) {
				proccessSend();
				$("input#messageInput").val('');
			}
		});

		socket.on( 'message', function( data ) {
			var actualContent = $( ".messages" ).html();

			console.log(data);

			// var newMsgContent = '<li> <strong>' + data.name + '</strong> : ' + data.message + '</li>';
			var newMsgContent = '';
			console.log(data.from_id);
			if (data.from_id != userID) {
				newMsgContent += '<li class="message left appeared others">';
				newMsgContent += '<span class="sender">' + data.name + '</span>';
				newMsgContent += '<div class="avatar"></div>';
				newMsgContent += '<div class="text_wrapper">';
				newMsgContent += '<div class="text">' + data.message + '</div>';
				newMsgContent += '</div>';
				newMsgContent += '</li>';
			} else {
				newMsgContent += '<li class="message left appeared mine">';
				newMsgContent += '<div class="text_wrapper">';
				newMsgContent += '<div class="text">' + data.message + '</div>';
				newMsgContent += '</div>';
				newMsgContent += '</li>';
			}

			var content = actualContent + newMsgContent;
			
			$( ".messages" ).html( content );
			$(".messages").animate({ scrollTop: $('.messages').prop("scrollHeight")}, 1000);
		});
	});
})();