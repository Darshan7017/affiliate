import React, { useEffect, useState } from "react";
import Success from "../images/success.png";
import Failed from "../images/failed.png";
import Pending from "../images/pending.png";
import { token } from "./Data";

const TransactionTable = () => {
  const [transactions, setTransactions] = useState([]);

  useEffect(() => {
    const fetchTransactions = async () => {
      try {
        // Replace with the actual endpoint and any necessary query parameters
        const response = await fetch(`https://fastback.in/api/trans?token=${token}`); 
        if (response.ok) {
          const data = await response.json();
          setTransactions(data.data);
        } else {
          console.error('Failed to fetch transactions');
        }
      } catch (error) {
        console.error('Error fetching transactions:', error);
      }
    };

    fetchTransactions();
  }, []);

  return (
    <div className="overflow-auto w-full">
      {transactions.length === 0 ? (
        <p className="text-center text-gray-500">No transactions available.</p>
      ) : (
        transactions.slice().reverse().map((transaction) => (
          <div
            key={transaction.id}
            className="bg-gray-200 mt-2 w-11/12 m-auto rounded p-4 flex items-center justify-between"
          >
            <div className="flex items-center">
              <img
                src={
                  transaction.status === "success"
                    ? Success
                    : transaction.status === "pending"
                    ? Pending
                    : Failed
                }
                alt={transaction.status}
                className="w-8 h-8 mr-4"
              />
              <div>
                <h3 className="text-md font-semibold">
                  Transaction {transaction.status}
                </h3>
                <p className="text-sm">{transaction.name} - {transaction.leads}</p>
              </div>
            </div>
            <div className="text-right">₹{transaction.amount}</div>
          </div>
        ))
      )}
    </div>
  );
};

export default TransactionTable;
