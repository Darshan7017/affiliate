import moment from 'moment';

const router = (req, res, connection) => {
    const token = req.query.token; // Get token from query params

    if (!token) {
        return res.status(400).json({ error: "Token is required" });
    }

    // Step 1: Validate the token and get the userid
    const tokenQuery = 'SELECT id FROM aff WHERE token = ?';
    connection.query(tokenQuery, [token], (error, tokenResults) => {
        if (error) {
            console.error('Error executing token query:', error);
            return res.status(500).json({
                status: 'error',
                message: 'Internal Server Error 1'
            });
        }

        if (tokenResults.length === 0) {
            return res.status(401).json({
                status: 'error',
                message: 'Invalid Token'
            });
        }

        const userid = tokenResults[0].id;
        const today = moment().format('YYYY-MM-DD');
        const lead = 1;
       
        const clicksQuery = `SELECT * FROM conversions WHERE userid = ? AND date = ?`;
        const conversionsQuery = `SELECT * FROM conversions WHERE userid = ? AND \`lead\` = '1' AND date = ?`;
        console.log(conversionsQuery)
        connection.query(clicksQuery, [userid, today], (err, clicksResult) => {
            if (err) {
                console.error('Error executing clicks query:', err);
                return res.status(500).json({ status: 'error', message: 'Internal Server Error 2' });
            }
            
            const totalClicks = clicksResult.length || 0;
            console.log(totalClicks)
            connection.query(conversionsQuery, [userid, today], (err, conversionsResult) => {
                if (err) {
                    console.error('Error executing conversions query:', err);
                    return res.status(500).json({ status: 'error', message: 'Internal Server Error 3' +err });
                }

                const totalConversions = conversionsResult.length || 0;

                // Now, fetch the offers along with the individual offer clicks and conversions
                const offerQuery = "SELECT id, name, category, model, event, payout FROM offer";
                connection.query(offerQuery, (err, offersResult) => {
                    if (err) {
                        console.error('Error executing offers query:', err);
                        return res.status(500).json({ status: 'error', message: 'Internal Server Error 4' });
                    }

                    // Process each offer to get its clicks and conversions
                    const offersData = offersResult.map((offer) => {
                        return new Promise((resolve, reject) => {
                            const offerId = offer.id;

                            // Query for individual leads and clicks per offer
                            const leadsQuery = `SELECT * FROM conversions WHERE userid = ? AND offerid = ?`;
                            const totalClicksQuery = `SELECT * FROM conversions WHERE userid = ? AND \`lead\` = '1' AND offerid = ?`;

                            connection.query(leadsQuery, [userid, offerId], (err, leadsResult) => {
                                if (err) return reject(err);

                                const leads = leadsResult.length || 0;

                                connection.query(totalClicksQuery, [userid, offerId], (err, totalClicksResult) => {
                                    if (err) return reject(err);

                                    const clicks = totalClicksResult.length || 0;

                                    // Create the offer object
                                    resolve({
                                        offerId: offer.id,
                                        offerName: offer.name,
                                        leads: clicks,
                                        clicks: leads
                                    });
                                });
                            });
                        });
                    });

                    // Resolve all promises and send the response
                    Promise.all(offersData)
                        .then((offers) => {
                            res.json({
                                status: 'success',
                                clicks: totalClicks,
                                conversions: totalConversions,
                                data: offers
                            });
                        })
                        .catch((err) => {
                            console.error('Error fetching offer data:', err);
                            res.status(500).json({ status: 'error', message: 'Internal Server Error 5' +err });
                        });
                });
            });
        });
    });
};

export default router;