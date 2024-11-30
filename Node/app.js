import express from 'express';
import bodyParser from 'body-parser';
import mysql from 'mysql';
import cors from 'cors';
import { registerUser } from './components/register.js'; 
import Offers from './components/offers.js';
import ccd from './components/ccd.js';
import Report from "./components/report.js";
import Invoice from "./components/invoice.js";
import Trans from "./components/trans.js";
import Update from "./components/update.js";

const app = express();
app.use(cors());
const port = 3000;

// MySQL connection setup
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'darshan',
  password: 'Darshan@117',
  database: 'affiliate'
});

connection.connect((err) => {
  if (err) {
    console.error('Error connecting to MySQL:', err.stack);
    return;
  }
  console.log('Connected to MySQL as id ' + connection.threadId);
});

// Middleware to parse JSON bodies
app.use(bodyParser.json());
app.use(express.json());
// Pass MySQL connection to the route handler

const datta = (sql, params) => {
      return new Promise((resolve, reject) => {
        connection.query(sql, params, (err, results) => {
          if (err) {
            return reject(err);
          }
          resolve(results);
        });
      });
    };
app.get('/', (req, res) => {
  const token = req.query.token; // Extract token from query parameter

  if (!token) {
    return res.status(400).json({
      status: 'error',
      message: 'Token is required'
    });
  }

  // Use token in a MySQL query
  const query = 'SELECT * FROM aff WHERE token = ?'; // Replace `your_table` with your table name

  connection.query(query, [token], (error, results) => {
    if (error) {
      console.error('Error executing query:', error);
      return res.status(500).json({
        status: 'error',
        message: 'Internal Server Error'
      });
    }

    if (results.length > 0) {
      // Assuming the VARBINARY column is named 'name' (replace it with your actual column name)
      results = results.map(row => {
        return {
          ...row,
          name: row.name.toString('utf-8') // Convert VARBINARY data to a UTF-8 string
        };
      });

      return res.json({
        status: 'success',
        message: 'Data retrieved successfully',
        data: results
      });
    } else {
      return res.status(404).json({
        status: 'error',
        message: 'No data found for the given token'
      });
    }
  });
});

app.get('/offers', (req, res) => {
  Offers(req, res, connection);
});

app.get('/report', (req, res) => {
  Report(req, res, datta);
});

app.get('/invoice', (req, res) => {
  Invoice(req, res, datta);
});

app.get('/ccd', (req, res) => {
  ccd(req, res, connection);
});

app.get('/trans', (req, res) => {
  Trans(req, res, datta);
});

app.get('/update', (req, res) => {
  Update(req, res, datta);
});

app.post('/register', (req, res) => {
  registerUser(req, res, connection);
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}/`);
});