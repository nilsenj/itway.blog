var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

var Redis = require('ioredis');

var redis = new Redis({port: 6379, host: '127.0.0.1', db: 0});
redis.subscribe('test-channel', function(err, count) {

});
redis.subscribe('post-created', function(err, count) {

});

redis.on('message', function(channel, message) {
    console.log('Message Recieved: ' + message);
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
});

redis.monitor(function (err, monitor) {

    monitor.on('monitor', function (time, args) {
        console.log('Time Received: ' + time);

        for(var i=0; i<=args.length; i++){

            console.log('argument: '+ i + args[i]);

        }
    });
});
http.listen(6378, function(){
    console.log('Listening on Port 6378');
});