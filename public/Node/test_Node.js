const express = require('express');
const app = express();

const PORT = process.env.PORT || 8080;
const IP = process.env.IP || '192.168.138.102';

app.listen(PORT, IP, () => {
  console.log(`Server running at ${IP}:${PORT}`);
});
