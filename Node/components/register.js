import { AuthDataValidator } from '@telegram-auth/server';

const validator = new AuthDataValidator({ botToken: '6778879803:AAHxP7Kv2yvTagI-5W_03Y46VARbuMFwJlI' });

// Function to handle registration or login
export async function registerUser(request, response, connection) {
  const data = request.body; 
  try {
    const { id, first_name, username, photo_url, auth_date, hash } = data;
    if (!id || !first_name || !username || !photo_url || !auth_date || !hash) {
    throw new Error("One or more fields are missing.");
    }
    // Check if the user already exists in the database
    const queryCheck = 'SELECT COUNT(*) AS count FROM aff WHERE tgid = ?';
    connection.query(queryCheck, [id], (err, result) => {
      if (err) {
        response.status(500).json({ error: 'Error querying data', details: err.stack });
      } else {
        const count = result[0].count;
        if (count > 0) {
          // If user exists, update their hash
          const queryUpdate = 'UPDATE aff SET token = ? WHERE tgid = ?';
          connection.query(queryUpdate, [hash, id], (err) => {
            if (err) {
              response.status(500).json({ error: 'Error updating data', details: err.stack });
            } else {
              response.json({ status: 'login', message: 'User updated successfully' });
            }
          });
        } else {
          // If user does not exist, insert a new record
          const queryInsert = 'INSERT INTO aff (tgid, name, photo, token, upi, postback, status) VALUES (?, ?, ?, ?, ?, ?, ?)';
          connection.query(queryInsert, [id, first_name, photo_url, hash, '', '', 'Active'], (err) => {
            if (err) {
              response.status(500).json({ status: 'server', message: 'Error inserting data', details: err.stack });
            } else {
              response.json({ status: 'register', message: 'User registered successfully' });
              console.log(err)
            }
          });
        }
      }
    });
  } catch (error) {
    response.status(400).json({ status: 'error', message: 'Invalid data', details: error.message });
  }
}