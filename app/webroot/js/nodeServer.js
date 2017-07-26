var socket = require( 'socket.io' );
var express = require( 'express' );
var http = require( 'http' );

var app = express();
var server = http.createServer( app );

var io = socket.listen( server );

var count = 0;

io.sockets.on( 'connection', function( client ) {
	// console.log(client);
	console.log( "New client !" );
	count++;
	console.log(count);

	client.on('new_login', function(data){
		io.sockets.emit('new_login', {userID: data.userID});
	});

	client.on('logout', function(data){
		io.sockets.emit('logout', {userID: data.userID});
	});
	
	
	
	client.on( 'message', function( data ) {
		console.log( 'Message received ' + data.name + ":" + data.message );
		
		//client.broadcast.emit( 'message', { name: data.name, message: data.message } );
		io.sockets.emit( 'message', { 
			name: data.name,
			message: data.message,
			from_id: data.from_id 
		} );
	});
});

server.listen( 8080 );