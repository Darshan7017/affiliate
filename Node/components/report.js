const fetchData = async (req, res, query) => {
  try {
    const token = req.query.token;
    const offerid = req.query.offerid;
    const from = req.query.from; 
    const to = req.query.to;

    if (!token) {
      return res.status(400).json({ error: "Token is required" });
    }
    
    if (!offerid) {
      return res.status(400).json({ error: "Offerid is required" });
    }
    
    if (!from) {
      return res.status(400).json({ error: "From is required" });
    }
    
    if (!to) {
      return res.status(400).json({ error: "To is required" });
    }

    // Fetch the token id
    const tokenResults = await query('SELECT id FROM aff WHERE token = ?', [token]);
    if (tokenResults.length === 0) {
      return res.status(401).json({ status: 'error', message: 'Invalid Token' });
    }
    
    const userid = tokenResults[0].id;

    // Fetch the lead conversions
    const leadConversionsResults = await query(
      `SELECT * FROM conversions WHERE userid=? AND \`lead\` = '1' AND offerid=? AND date BETWEEN ? AND ?`, 
      [userid, offerid, from, to]
    );
    const leadConversions = leadConversionsResults.length;

    // Fetch the total conversions
    const totalConversionsResults = await query(
      `SELECT * FROM conversions WHERE userid=? AND offerid=? AND date BETWEEN ? AND ?`,
      [userid, offerid, from, to]
    );
    const totalConversions = totalConversionsResults.length;

    // Fetch the offer name
    const offerResults = await query('SELECT name, payout FROM offer WHERE id = ?', [offerid]);
    const offerName = offerResults.length > 0 ? offerResults[0].name : 'Unknown Offer';
    const offerPayout = offerResults.length > 0 ? offerResults[0].payout : 'Unknown Offer';

    // Send the final response with all stored data
    return res.json({
      status: 'success',
      offerid,
      offerName,
      payout: offerPayout,
      lead: leadConversions,
      click: totalConversions
    });
  } catch (error) {
    console.error('Error executing query:', error);
    return res.status(500).json({
      status: 'error',
      message: 'Internal Server Error'
    });
  }
};

export default fetchData;