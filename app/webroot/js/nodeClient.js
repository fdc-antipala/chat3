(function(){
	$(document).ready(function(){
		var nameVal = $('.bottom_wrapper').data().name;
		var userID = $('.bottom_wrapper').data().id;
		console.log('USERID: ' + userID);
		var recipientID = localStorage.getItem('currentChatID');
		var recipientName = localStorage.getItem('currentChatName');
		
		if (typeof recipientID == 'undifined' || recipientID == null) {
			$('.chatContent ul.messages').html('empty');
			$('.chatHeaderContainer').hide();
		}

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
		$('i.fa.fa-phone').click(function(e){
			e.preventDefault();
			ajaxLogout();
		});

		function ajaxLogout() {
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
		}

		socket.on( 'logout', function( data ) {
			console.log('update logout dom');
			$('a[data-id="' + data.userID +'"]').attr('class', 'off');
			$('a[data-id="' + data.userID +'"] p.contactStatus').text('Offline');
		});

		function proccessSend () {
			
			var msg = $( "#messageInput" ).val();
			if (msg == "" || msg == " ")
				return false;
			
			socket.emit( 'message', { name: nameVal, message: msg, from_id: userID, to_id: recipient} );
			
			// Ajax call for saving datas
			$.ajax({
				url : BASEURL + 'chats/insertNewMessage',
				type: "POST",
				data: { 
					name: nameVal,
					message: msg,
					from_id: userID,
					to_id: recipient
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
			$('a[data-id="' + data.userID +'"] p.contactStatus').text('Online');
			
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

		/**
		 * logout after 5 minutes idle
		 */
		var idleTime = 0;
		function timerIncrement() {
			idleTime = idleTime + 1;
			if (idleTime > 10) { // 5 minutes
				socket.emit('logout', {userID: userID});
				ajaxLogout();
			}
		}

		//Increment the idle time counter every minute.
		var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

		//Zero the idle timer on mouse movement.
		$(this).mousemove(function (e) {
		idleTime = 0;
		});
		$(this).keypress(function (e) {
			idleTime = 0;
		});

		/**
		 * for chat loading ajax
		 */
		$('.contactList ul li a').click(function(e){
			e.preventDefault();
			$('.contactList ul').find('li').removeClass('active');
			$(this).parent().addClass('active');

			var currentChatName = $(this).data().name;
			var currentChatID = $(this).data().id;
			localStorage.setItem('currentChatID', currentChatID);
			localStorage.setItem('currentChatNamec', currentChatName);

			console.log(userID + ' ' + currentChatID);

			recipient = currentChatID;
			$('.chatHeaderContainer').show();
			$('.currentContactInfo p.fullName').text(currentChatName);

			$.ajax({
				url: 'http://localhost:8012/chat3/users/getMessages',
				type: 'POST',
				data: { 'from_id': userID, 'to_id': currentChatID},
				success: function(data){
					console.log(data);
					if (JSON.parse(data) != 'empty'){
						var sorted = JSON.parse(data).sort(function (a, b) {
							return a.id - b.id;
						});
						viewSorted(sorted);
					} else {
						$('ul.messages').html('empty');
					}
					
				},
				error: function(){
					console.log('error');
				}
			});
		});

		function viewSorted (data) {
			var output = '';
			$.each(data, function(key, val){
				// console.log(val.message);
				if (val.from_id != userID) {
					output += '<li class="message left appeared others">';
					output += '<span class="sender">' + val.name + '</span>';
					output += '<div class="avatar"></div>';
					output += '<div class="text_wrapper">';
					output += '<div class="text">' + val.message + '</div>';
					output += '</div>';
					output += '</li>';
				} else {
					output += '<li class="message left appeared mine">';
					output += '<div class="text_wrapper">';
					output += '<div class="text">' + val.message + '</div>';
					output += '</div>';
					output += '</li>';
				}
				$('ul.messages').html(output);
			});
		}
	});
})();