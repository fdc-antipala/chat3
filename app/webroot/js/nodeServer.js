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
	// console.log(client.id);
	console.log(client.store.id);

	client.on('new_login', function(data){
		io.sockets.emit('new_login', {userID: data.userID});
	});

	client.on('logout', function(data){
		io.sockets.emit('logout', {userID: data.userID});
	});
	
	
	
	client.on( 'message', function( data ) {
		console.log( 'Message received ' + data.name + ":" + data.message );
		console.log(data.senderid);
		 io.sockets.socket(data.clientid).emit('message', {
			// msg: data.msg,
			// senderid : socket.id
			name: data.name,
			message: data.message,
			from_id: data.from_id ,
			senderid : socket.id
		}); 
		
		//client.broadcast.emit( 'message', { name: data.name, message: data.message } );
		// data.broadcast.emit( 'message', { 
		io.sockets.emit( 'message', { 
			name: data.name,
			message: data.message,
			from_id: data.from_id 
		} );
	});
});

server.listen( 8080 );