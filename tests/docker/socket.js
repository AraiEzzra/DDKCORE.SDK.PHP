const server = require('http').Server();
const io = require('socket.io')(server);

const Redis = require('ioredis');
const redis = new Redis(6379, 'redis');

redis.subscribe('echo', function () {
    console.log('Subscription successful');
});

redis.on('message', function(channel, message) {
    console.log(channel, message);
    io.emit(channel, message);
});

server.listen(3000);
