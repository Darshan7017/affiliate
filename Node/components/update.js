import express from 'express';

const updateDetails = async (req, res, query) => {
  const { token, type, value } = req.query;

  // Check if required fields are provided
  if (!token) {
    return res.status(400).json({ error: "Token is required"+ token });
  }

  if (!type || !value) {
    return res.status(400).json({ error: "Type and value are required" });
  }

  try {
    // Step 1: Find the user by token
    const userResults = await query('SELECT id FROM aff WHERE token = ?', [token]);

    if (userResults.length === 0) {
      return res.status(401).json({ error: "Invalid Token" });
    }

    const userId = userResults[0].id;

    // Step 2: Update the correct field based on type
    let updateQuery = "";
    if (type === "postback") {
      updateQuery = 'UPDATE aff SET postback = ? WHERE id = ?';
    } else if (type === "upi") {
      updateQuery = 'UPDATE aff SET upi = ? WHERE id = ?';
    } else {
      return res.status(400).json({ error: "Invalid update type. Allowed types are 'postback' or 'upi'." });
    }

    // Execute the update query
    await query(updateQuery, [value, userId]);

    // Step 3: Respond with success
    return res.status(200).json({
      status: 'success',
      message: `User ${type} updated successfully`
    });
  } catch (error) {
    console.error('Error updating user details:', error);
    return res.status(500).json({ status: 'error', message: 'Internal Server Error' });
  }
};

export default updateDetails;