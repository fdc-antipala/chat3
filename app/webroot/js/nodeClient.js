(function(){
	$(document).ready(function(){
		var nameVal = $('.bottom_wrapper').data().name;
		var userID = $('.bottom_wrapper').data().id;
		console.log('USERID: ' + userID);

		$(".messages").animate({ scrollTop: $('.messages').prop("scrollHeight")}, 1000);
		var socket = io.connect( 'http://localhost:8080' );
		var ORIGIN = window.location.origin;
		var PATH = window.location.pathname;
		var BASEURL = ORIGIN + '/chat3/';

		$( "#send" ).click( function() {
			proccessSend();
			$("input#messageInput").val('');
		});

		// Logout...
		$('a#logout').click(function(e){
			e.preventDefault();
			$.ajax({
				url : BASEURL + 'users/updateLogoutStatus',
				type: "POST",
				data : { 'userID': userID},
				success: function() {
					socket.emit('logout', {userID: userID});
					window.location.replace(BASEURL + 'users/index');
				},
				error: function(){console.log('error logout');}
			});
		});

		socket.on( 'logout', function( data ) {
			console.log('update logout dom');
			$('a[data-id="' + data.userID +'"]').attr('class', 'off');

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

		// send broadcast to trigger update login status
		// every page is reload.
		socket.emit('new_login', {userID: userID});

		socket.on( 'new_login', function( data ) {
			
			$('a[data-id="' + data.userID +'"]').attr('class', 'on');
			
			// update user last login time
			if (userID == data.userID) {
				$.ajax({
					url :  BASEURL + 'Users/updateLastLoginTime',
					type :'POST',
					data : { 'userID': data.userID},
					success : function(){console.log('success');},
					error : function(){console.log('error');},
				});
			}
		});

		socket.on( 'message', function( data ) {

			var actualContent = $( ".messages" ).html();

			console.log('on message');

			// var newMsgContent = '<li> <strong>' + data.name + '</strong> : ' + data.message + '</li>';
			var newMsgContent = '';
			// console.log(data.from_id);
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