const Invoice = async (req, res, query) => {
    const { token, offerid, from, to } = req.query;
    
    if (!token) {
        return res.status(400).json({ error: "Token is required" });
    }

    try {
        // Step 1: Validate the token and get the userid
        const tokenResults = await query('SELECT id, name FROM aff WHERE token = ?', [token]);

        if (tokenResults.length === 0) {
            return res.status(401).json({ status: 'error', message: 'Invalid Token' });
        }

        const userid = tokenResults[0].id;
        const username = tokenResults[0].name;

        // Step 2: Check if an invoice with the same offerid, userid, and 'pending' status already exists
        const invoiceCheck = await query(
            'SELECT * FROM invoice WHERE userid=? AND offerid=? AND status="pending"',
            [userid, offerid]
        );
        
        if (invoiceCheck.length > 0) {
            return res.status(400).json({ status: 'already', message: 'Invoice with pending status already exists' });
        }

        // Step 3: Fetch offer details from the external API
        const response = await fetch(`https://fastback.in/api/report/?token=${token}&from=${from}&to=${to}&offerid=${offerid}`);
        const result = await response.json();

        if (result.status !== 'success' || result.lead == 0) {
            return res.status(400).json({ status: 'error', message: '0 lead'});
        }

        // Calculate payment and other details
        let pay = parseInt(result.lead) * result.payout;
        const offername = result.offerName; // Assuming static for now, update if dynamic
        const rows6 = result.lead;
        const payable = pay;
        const insertQuery = `
            INSERT INTO invoice (offerid, userid, name, leads, amount, status)
            VALUES (?, ?, ?, ?, ?, 'pending')
        `;
        await query(insertQuery, [offerid, userid, offername, rows6, payable]);

        // Prepare message for Telegram
        const botToken = '6778879803:AAHxP7Kv2yvTagI-5W_03Y46VARbuMFwJlI'; // Replace with your bot token
        const chatId = '1516610662'; // Replace with your chat ID
        const tex = `<b>🥳 New Payment Request By User 🥳

⛔️ User :- ${username} 
💼 Offer :- ${offername} (${offerid})

📤 Payment Details :- <code>${pay}</code>

🗓️From Date :- ${from}

🗓️To Date :- ${to}

🍂 Offer Total Leads :- ${rows6}

♻️ AMOUNT TO PAY :- Rs.<code>${payable}</code>

💬 Payment Comment : - <code> ${offername} Payment</code>
</b>`;

        // Step 5: Send a notification to Telegram
        await fetch(`https://api.telegram.org/bot${botToken}/sendMessage`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                chat_id: chatId,
                text: tex,
                parse_mode: 'HTML',
            }),
        });

        // Respond with success
        return res.status(200).json({ status: 'success', message: 'Invoice created and notification sent.' });

    } catch (error) {
        console.error('Error processing invoice:' +error);
        return res.status(500).json({ status: 'error', message: 'Internal Server Error' });
    }
};

export default Invoice;