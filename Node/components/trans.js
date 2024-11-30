// trans.js

const getInvoiceDetails = async (req, res, query) => {
    const { token } = req.query;

    if (!token) {
        return res.status(400).json({ error: "Token is required" });
    }

    try {
        // Step 1: Validate the token and get the user ID
        const tokenResults = await query('SELECT id FROM aff WHERE token = ?', [token]);

        if (tokenResults.length === 0) {
            return res.status(401).json({ status: 'error', message: 'Invalid Token' });
        }

        const userid = tokenResults[0].id;

        // Step 2: Fetch all invoices related to this user
        const invoices = await query('SELECT * FROM invoice WHERE userid = ?', [userid]);

        if (invoices.length === 0) {
            return res.status(404).json({ status: 'error', message: 'No invoices found for this user' });
        }

        // Step 3: Send the invoice details as a JSON response
        return res.status(200).json({
            status: 'success',
            data: invoices,
        });

    } catch (error) {
        console.error('Error fetching invoice details:', error);
        return res.status(500).json({
            status: 'error',
            message: 'Internal Server Error',
        });
    }
};

export default getInvoiceDetails;