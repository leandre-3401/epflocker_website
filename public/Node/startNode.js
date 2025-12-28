var http = require('http');
var server = http.createServer(function(req, res) {
  res.writeHead(200);
  res.end('ENFIN PTN!');
});
server.listen(8080);
console.log("Server Ok");