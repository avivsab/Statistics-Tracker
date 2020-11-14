const mysql = require('mysql2/promise');
const express = require('express');
const router = express.Router();

let pool;

(async function initializePool() {
    pool = mysql.createPool({
       host: 'localhost',
       user: 'root',
       password: 'your_password',
       database: 'clicks',
       waitForConnections: true,
       connectionLimit: 10,
       queueLimit: 0
   });
})();


router.get('/', async (req,res) => {

    const [results, fields] = await pool.execute('select * from statistics');
    res.send(results);
    
 });

 module.exports = router;