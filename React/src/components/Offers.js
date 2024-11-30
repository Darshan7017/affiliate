import React, { useState, useEffect } from "react";
import Header from "./assets/Header";
import Navbar from "./assets/Navbar";
import Card from "./assets/Card";
import Table from "./assets/tailwind/Table";
import { token, useData } from "./assets/Data";
import Drawer from "@mui/material/SwipeableDrawer";
import Input from "./assets/tailwind/Input";
import { LoadingButton as Btn } from "@mui/lab";
import { message } from "antd";

const Offers = () => {
    const { data: userData } = useData();
    const headers = ["Id", "Name", "Model", "Link"];

    const [offers, setOffers] = useState([]);
    const [isLoading, setIsLoading] = useState(true);
    const [open, setOpen] = useState(false);
    const [selectedOffer, setSelectedOffer] = useState(null); // State to hold clicked offer data

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

    const toggleDrawer = (newOpen, offer) => () => {
        setOpen(newOpen);
        if (newOpen && offer) {
            setSelectedOffer(offer); // Set the offer details to show in the Drawer
        }
    };

    const handleCopyClick = () => {
        navigator.clipboard.writeText(selectedOffer.trackingLink);
        message.success("Link Copied!");
    };

    // Map offers data to table format
    const offerData = offers.map(offer => [
        offer.offerid,
        offer.name,
        offer.model,
        <button
            type="button"
            onClick={toggleDrawer(true, offer)} // Pass the clicked offer to toggleDrawer
            className="bg-cyan-400 px-2 py-1 rounded text-white"
        >
            Link
        </button>
    ]);

    // Skeleton loader with pulse animation
    const skeletonData = Array(5).fill([
        <div className="h-4 bg-gray-300 rounded animate-pulse"></div>,
        <div className="h-4 bg-gray-300 rounded animate-pulse"></div>,
        <div className="h-4 bg-gray-300 rounded animate-pulse"></div>,
        <div className="h-4 bg-gray-300 rounded animate-pulse"></div>
    ]);

    return (
        <div>
            {/* Drawer with selected offer's data */}
            <Drawer
                anchor="bottom"
                open={open}
                onClose={toggleDrawer(false)}
                onOpen={toggleDrawer(true)}
            >
                <div className="p-10">
                    {selectedOffer ? (
                        <>
                            <img
                                src="https://fastback.in/success.gif"
                                alt="Success"
                                className="w-32 mx-auto"
                            />
                            <h1 className="text-xl text-center font-bold">
                                Tracking Link
                            </h1>
                            <hr className="my-2" />
                            <table className="w-full border-collapse mt-2">
                                <tbody className="text-gray-500">
                                    <tr>
                                        <td className="text-left">
                                            Offer Name
                                        </td>
                                        <td className="text-right">
                                            {selectedOffer.name}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="text-left">Modal</td>
                                        <td className="text-right">
                                            {selectedOffer.model}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="text-left">Payout</td>
                                        <td className="text-right">
                                            {selectedOffer.payout}₹
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="text-left">Category</td>
                                        <td className="text-right">
                                            {selectedOffer.category}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td className="text-left">Event</td>
                                        <td className="text-right">
                                            {selectedOffer.event}
                                        </td>
                                    </tr>
                                    {selectedOffer.sevent !== "no" && (
                                        <tr>
                                            <td className="text-left">
                                                Second Event
                                            </td>
                                            <td className="text-right">
                                                {selectedOffer.sevent}
                                            </td>
                                        </tr>
                                    )}
                                </tbody>
                            </table>

                            <hr className="my-4" />
                        </>
                    ) : (
                        <p>No offer selected</p>
                    )}
                    <Input
                        type="text"
                        value={selectedOffer ? selectedOffer.trackingLink : ""}
                        icon="hugeicons:link-01"
                        readOnly
                    />
                    <Btn
                        type="button"
                        onClick={handleCopyClick}
                        variant="contained"
                        sx={{ mt: 2, height: 45 }}
                        fullWidth
                    >
                        Copy Link
                    </Btn>
                </div>
            </Drawer>

            <Header />
            <Card
                icon="basil:user-outline"
                head="Username"
                data={userData.name}
                bg="bg-cyan-500"
            />
            {isLoading ? (
                <Table
                    head="Offers"
                    headers={headers}
                    data={skeletonData}
                    maxHeight={350}
                />
            ) : (
                <Table
                    head="Offers"
                    headers={headers}
                    data={offerData}
                    maxHeight={350}
                />
            )}
            <Navbar />
        </div>
    );
};

export default Offers;
