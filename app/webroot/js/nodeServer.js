var socket = require( 'socket.io' );
var express = require( 'express' );
var http = require( 'http' );

var app = express();
var server = http.createServer( app );

var io = socket.listen( server );

var count = 0;
var basket = {};

io.sockets.on( 'connection', function( client ) {
	// console.log(client);
	console.log( "New client !" );
	count++;
	console.log(count);
	// console.log(client.id);
	// console.log(client.store.id);

	client.on('new_login', function(data){
		console.log(data.userID);
		console.log(client.id);
		basket[data.userID] = client.id;
		io.sockets.emit('new_login', {userID: data.userID});
	});

	client.on('logout', function(data){
		io.sockets.emit('logout', {userID: data.userID});
	});
	
	client.on( 'message', function( data ) {
		console.log(data.to_id);
		var to = basket[data.to_id];
		var from = basket[data.from_id];

		io.sockets.socket(to).emit('message',{ 
			name: data.name,
			message: data.message,
			from_id: data.from_id,
			to_id: data.to_id
		} );
		io.sockets.socket(from).emit('message',{ 
			name: data.name,
			message: data.message,
			from_id: data.from_id,
			to_id: data.to_id
		} );
		
		// io.to(to).emit( 'message', { 
		// 	name: data.name,
		// 	message: data.message,
		// 	from_id: data.from_id,
		// 	to_id: data.to_id
		// } );
	});
});

server.listen( 8080 );