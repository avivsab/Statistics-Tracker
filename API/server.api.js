const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");

const app = express();
const route = require('./routes/statistics');
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
app.use(cors());


app.use('/', route)


const port = 8200;
app.listen(port, () => {
    console.log('server started - ', port);
});