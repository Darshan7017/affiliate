import React, { useState, useEffect } from "react";
import Header from "./assets/Header";
import Navbar from "./assets/Navbar";
import Card from "./assets/Card";
import { token, useData } from "./assets/Data";
import Drawer from "@mui/material/SwipeableDrawer";
import Input from "./assets/tailwind/Input";
import { LoadingButton as Btn } from "@mui/lab";
import { message } from "antd";
import Select from "./assets/tailwind/Select";
import TransactionTable from "./assets/TransactionTable";

const Report = () => {
    const { data: userData } = useData();
    const [date, setDate] = useState("");
    const [tableKey, setTableKey] = useState(0);
    const [data, setData] = useState("");
    const [open, setOpen] = useState(false);
    const [date1, setDate1] = useState("");
    const [isLoading, setIsLoading] = useState(true);
    const [offers, setOffers] = useState([]);
    const [offerid, setOfferid] = useState("");
    const [tpay, setTpay] = useState(0);
    const [isFocused, setIsFocused] = useState(false);
    const [isFocused1, setIsFocused1] = useState(false);
    const [disabled, setDisabled] = useState(false);

    const handleDateChange = e => {
        const selectedDate = new Date(e.target.value);
        const formattedDate = selectedDate.toISOString().split("T")[0]; // Format to YYYY-MM-DD
        setDate(formattedDate);
    };

    const handleDateChange1 = e => {
        const selectedDate = new Date(e.target.value);
        const formattedDate = selectedDate.toISOString().split("T")[0]; // Format to YYYY-MM-DD
        setDate1(formattedDate);
    };

    const handleFocus = () => {
        setIsFocused(true);
    };

    const handleFocus1 = () => {
        setIsFocused1(true);
    };

    const handleBlur = () => {
        setIsFocused(false);
    };

    const handleBlur1 = () => {
        setIsFocused1(false);
    };

    const getreport = async () => {
        if (!offerid) {
            message.error("Please Select An Offer");
            return;
        } else if (!date) {
            message.error("Please Choose From Date");
            return;
        } else if (!date1) {
            message.error("Please Choose To Date");
            return;
        }
        setIsLoading(true);
        try {
            const response = await fetch(
                `https://fastback.in/api/report/?token=${token}&from=${date}&to=${date1}&offerid=${offerid}`
            );
            const result = await response.json();
            if (result.status === "success") {
                let pay = parseInt(result.lead) * result.payout;
                setTpay(pay);
                setData(result);
                setOpen(true);
            }
        } catch (error) {
            console.error("Error fetching offers:", error);
        } finally {
            setIsLoading(false); // Set loading to false after fetching
        }
    };

    const rpayment = async () => {
        if (!userData.upi) {
            message.error("Please Update Your UPI ID From Profile");
            return;
        }
        if (data.lead <= 0) {
            message.error("You Can't Request Payment For 0 Lead");
            return;
        }
        setIsLoading(true);
        message.loading("Requesting Payment");
        try {
            const response = await fetch(
                `https://fastback.in/api/invoice/?token=${token}&offerid=${offerid}&from=${date}&to=${date1}`
            );
            const result = await response.json();
            if (result.status === "success") {
                message.success("Payment Requested Successfully");
                setDisabled(true);
                setTableKey(prevKey => prevKey + 1);
            } else if (result.status === "already") {
                message.warning(
                    "Payment Request Already Submitted"
                );
                setDisabled(true);
            } else if (result.status === "error") {
                message.error(result.message);
            }
        } catch (error) {
            message.error("Internal Server Error");
        } finally {
            setIsLoading(false); // Set loading to false after fetching
        }
    };

    useEffect(() => {
        const fetchOffers = async () => {
            try {
                const response = await fetch(
                    `https://fastback.in/api/offers/?token=${token}`
                );
                const result = await response.json();
                if (result.status === "success") {
                    setOffers(result.data); // Update offers with fetched data
                }
            } catch (error) {
                console.error("Error fetching offers:", error);
            } finally {
                setIsLoading(false); // Set loading to false after fetching
            }
        };

        fetchOffers();
    }, []);

    return (
        <div>
            <Drawer
                anchor="bottom"
                open={open}
                onClose={() => setOpen(false)}
                onOpen={() => setOpen(true)}
            >
                <div className="p-10">
                    <div className="text-center">
                        <img
                            src="https://fastback.in/success.gif"
                            alt="Success"
                            className="w-32 mx-auto"
                        />
                        <h1 className="text-xl font-bold">Report Fetched</h1>
                        <hr className="my-2" />
                        <table className="w-full border-collapse mt-2">
                            <tbody className="text-gray-500">
                                <tr>
                                    <td className="text-left">Offer Name</td>
                                    <td className="text-right">
                                        {data.offerName}
                                    </td>
                                </tr>
                                <tr>
                                    <td className="text-left">
                                        {data.click > 1 ? "Clicks" : "Click"}
                                    </td>
                                    <td className="text-right">{data.click}</td>
                                </tr>
                                <tr>
                                    <td className="text-left">
                                        {data.lead > 1
                                            ? "Conversions"
                                            : "Conversion"}
                                    </td>
                                    <td className="text-right">{data.lead}</td>
                                </tr>
                                <tr>
                                    <td className="text-left">Offer Payout</td>
                                    <td className="text-right">
                                        {data.payout}₹
                                    </td>
                                </tr>
                                <tr>
                                    <td className="text-left">Total Payout</td>
                                    <td className="text-right">{tpay}₹</td>
                                </tr>
                            </tbody>
                        </table>

                        <hr className="my-4" />

                        <Btn
                            type="button"
                            onClick={rpayment}
                            variant="contained"
                            sx={{ mt: 2, height: 45 }}
                            fullWidth
                            disabled={disabled}
                            loading={isLoading}
                        >
                            Request Payment
                        </Btn>
                    </div>
                </div>
            </Drawer>
            <Header />
            <Card
                icon="basil:user-outline"
                head="Username"
                data={userData.name}
                bg="bg-cyan-500"
            />
            <Select
                label="Select Offer"
                icon="solar:gift-linear"
                className="w-10/12 m-auto"
                onChange={e => setOfferid(e.target.value)}
            >
                {offers.map(offer => (
                    <option key={offer.offerid} value={offer.offerid}>
                        {offer.name}
                    </option>
                ))}
            </Select>
            <div className="relative">
                {!isFocused && !date && (
                    <label className="absolute top-0 left-16 px-4 py-3 z-50 text-sm pointer-events-none">
                        Select From Date
                    </label>
                )}
                <Input
                    label="" // We don't need the label inside the input in this case
                    type="date"
                    icon="clarity:date-line"
                    value={date}
                    className="w-10/12 m-auto"
                    onChange={handleDateChange}
                    onFocus={handleFocus} // Set focus to true when the input is focused
                    onBlur={handleBlur} // Set focus to false when the input is blurred
                />
            </div>
            <div className="relative">
                {!isFocused1 && !date1 && (
                    <label className="absolute top-0 left-16 px-4 py-3 z-50 text-sm pointer-events-none">
                        Select To Date
                    </label>
                )}
                <Input
                    label="" // We don't need the label inside the input in this case
                    type="date"
                    icon="clarity:date-line"
                    value={date1}
                    className="w-10/12 m-auto"
                    onChange={handleDateChange1}
                    onFocus={handleFocus1} // Set focus to true when the input is focused
                    onBlur={handleBlur1} // Set focus to false when the input is blurred
                />
            </div>
            <div className="w-10/12 m-auto">
                <Btn
                    type="button"
                    variant="contained"
                    sx={{ mt: 2, height: 45 }}
                    fullWidth
                    loading={isLoading}
                    onClick={getreport}
                >
                    Get Report
                </Btn>
            </div>
            <hr className="my-2" />
            <div className="container mx-auto p-5">
                <h1 className="text-xl font-bold mb-4 text-center">
                    Transaction History
                </h1>
                <TransactionTable key={tableKey} />
                <div className="mb-14"></div>
            </div>
            <Navbar />
        </div>
    );
};

export default Report;
