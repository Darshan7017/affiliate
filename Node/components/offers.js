const offers = (req, res, connection) => {
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
                message: 'Internal Server Error' +error
            });
        }

        if (tokenResults.length === 0) {
            return res.status(401).json({
                status: 'error',
                message: 'Invalid Token'
            });
        }

        const userid = tokenResults[0].id; // Get the userid from token results

        // Step 2: Fetch offers if token is valid
        const offersQuery = "SELECT * FROM offer";
        connection.query(offersQuery, [userid], (error, offerResults) => {
            if (error) {
                console.error('Error executing offers query:', error);
                return res.status(500).json({
                    status: 'error',
                    message: 'Internal Server Error'+error
                });
            }

            // Step 3: Process and return the offers
            const offers = offerResults.map(record => ({
                offerid: record.id,
                name: record.name,
                bg: record.bg,
                model: record.model,
                category: record.category,
                event: record.event,
                sevent: record.d_event,
                payout: record.payout,
                trackingLink: `https://fastback.in/affiliate/c?o=${record.id}&a=${userid}&aff_click_id={aff_click_id}&sub_aff_id={sub_aff_id}`
            }));

            return res.json({
                status: 'success',
                data: offers
            });
        });
    });
}

export default offers;