import React, { useState } from "react";
import Header from "./assets/Header";
import Navbar from "./assets/Navbar";
import Card from "./assets/Card";
import Drawer from "@mui/material/SwipeableDrawer";
import Pbtn from "./assets/Button";
import Input from "./assets/tailwind/Input";
import { useData, token } from "./assets/Data";
import { LoadingButton as Btn } from "@mui/lab";
import { message } from "antd"; 

const Profile = () => {
    const { data: userData, setUpdate } = useData();
    const [purl, setPurl] = useState(userData.postback);
    const [nupi, setNupi] = useState(userData.upi);
    const [open, setOpen] = useState(false);
    const [jsx, setJsx] = useState(null);
    const [isLoading, setIsLoading] = useState(false);

    const uurl = async () => {
        setIsLoading(true);
        try {
            const response = await fetch(
                `https://fastback.in/api/update?type=postback&value=${encodeURIComponent(
                    purl
                )}&token=${token}`
            );

            const result = await response.json();

            if (response.ok) {
                message.success("Postback URL updated successfully!");
                setUpdate("isj338");
            } else {
                message.error(
                    result.message || "Failed to update Postback URL."
                );
            }
        } catch (error) {
            message.error("An error occurred while updating Postback URL.");
        } finally {
            setIsLoading(false);
            setOpen(false); // Close the drawer
        }
    };

    // Function to handle UPI ID update using GET method
    const uupi = async () => {
        setIsLoading(true);
        try {
            const response = await fetch(
                `https://fastback.in/api/update?type=upi&value=${nupi}&token=${token}`
            );
            const result = await response.json();
            if (response.ok) {
                message.success("UPI ID updated successfully!");
                setUpdate("isiwiw8w");
            } else {
                message.error(result.message || "Failed to update UPI ID.");
            }
        } catch (error) {
            message.error("An error occurred while updating UPI ID.");
        } finally {
            setIsLoading(false);
            setOpen(false); // Close the drawer
        }
    };

    // UI for Postback update

    // UI for UPI update

    const toggleDrawer = (newOpen, jsxContent) => () => {
        setOpen(newOpen);
        setJsx(jsxContent);
    };

    return (
        <div>
            <Header />
            <Drawer
                anchor="bottom"
                open={open}
                onClose={toggleDrawer(false)}
                onOpen={toggleDrawer(true)}
            >
                <div className="p-10">
                    {jsx === "upi" && (
                        <>
                            <div className="text-lg font-semibold flex items-center justify-center">
                                Fastback - Upi
                            </div>
                            <div className="relative">
                                <Input
                                    type="text"
                                    label="Enter Upi Id"
                                    className="w-full"
                                    icon="hugeicons:payment-success-01"
                                    value={nupi}
                                    onChange={e => setNupi(e.target.value)}
                                />
                            </div>
                            <Btn
                                type="button"
                                variant="contained"
                                sx={{ mt: 2, height: 45 }}
                                fullWidth
                                loading={isLoading}
                                onClick={uupi}
                            >
                                Update Upi ID
                            </Btn>
                        </>
                    )}
                    {jsx === "postback" && (
                        <>
                            <div className="text-lg font-semibold flex items-center justify-center">
                                Fastback - Upi
                            </div>
                            <div className="relative">
                                <Input
                                    type="text"
                                    label="Enter Postback Url"
                                    className="w-full"
                                    icon="ic:outline-add-link"
                                    value={purl}
                                    onChange={e => setPurl(e.target.value)}
                                />
                            </div>
                            <Btn
                                type="button"
                                variant="contained"
                                sx={{ mt: 2, height: 45 }}
                                fullWidth
                                loading={isLoading}
                                onClick={uurl}
                            >
                                Update Postback Url
                            </Btn>
                          <p className="text-center mt-3">{`Parameters:  {aff_click_id},{sub_aff_id},{offerid},{event_name},{ip}`}</p>
                        </>
                    )}
                    {jsx === "about" && (
                        <div>
                            <div className="text-lg font-semibold flex items-center justify-center">
                                {" "}
                                Terms & Conditions{" "}
                            </div>
                            <p>
                                <div className="mt-2">
                                    {" "}
                                    1. Fake Convertions Are Not Payable.{" "}
                                </div>{" "}
                                <div className="mt-2">
                                    {" "}
                                    2. Minimum 1+ Leads Payable.
                                </div>
                                <div className="mt-2">
                                    {" "}
                                    3. Don't contact for payment. Send request
                                    when said in the channel..{" "}
                                </div>
                                <div className="mt-2">
                                    4. All Payment Are Done At The Basis Of
                                    Final Report.
                                </div>
                                <div className="mt-2">
                                    {" "}
                                    5. If You Not Run Any Campaign Till 15 Days
                                    Than We Have To Remove You From Channel &
                                    Diactivate Your Account
                                </div>
                            </p>
                        </div>
                    )}
                </div>
            </Drawer>

            <Card
                icon="basil:user-outline"
                head="Username"
                data={userData.name}
                bg="bg-cyan-500"
            />
            <Pbtn
                text="Update Upi Address"
                icon="hugeicons:payment-success-01"
                onClick={toggleDrawer(true, "upi")}
            />
            <Pbtn
                text="Update Postback Url"
                onClick={toggleDrawer(true, "postback")}
                icon="ic:outline-add-link"
            />
            <Pbtn
                text="About Us"
                icon="mdi:about-circle-outline"
                onClick={toggleDrawer(true, "about")}
            />
            <a href="https://fastback.in/fastback.apk" download>
                <Pbtn text="Download App" icon="material-symbols:download" />
            </a>
            <a href="https://t.me/+hsjvMkVO5c4zOTQ1">
                <Pbtn
                    text="Join Telegram"
                    icon="material-symbols-light:campaign-sharp"
                />
            </a>
            <Navbar />
        </div>
    );
};

export default Profile;
