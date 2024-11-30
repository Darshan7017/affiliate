import React, { createContext, useContext, useState, useEffect } from "react";

const MyContext = createContext();

export const useData = () => useContext(MyContext);

export const Userdata = ({ children }) => {
    const [data, setData] = useState("");
    const [loading, setLoading] = useState(false);
    const [update, setUpdate] = useState("");
    const location = window.location.pathname; // No need for state here
    const token = localStorage.getItem("token");

    useEffect(() => {
        const fetchData = async () => {
            setLoading(true);
            if (location !== "/affiliate/login") {
                try {
                    const response = await fetch(
                        `https://fastback.in/api/?token=${token}`
                    );
                    const ndata = await response.json();

                    // Make sure that ndata.data exists and has at least one element
                    if (ndata.data && ndata.data[0].status === "Active") {
                        setData(ndata.data[0]);
                    } else {
                        handleLogout();
                    }
                } catch (error) {
                    console.error("Error fetching data:", error);
                    handleLogout();
                } finally {
                    setLoading(false);
                }
            }
        };

        const handleLogout = () => {
            // Clear the token
            localStorage.clear();
            // Delay the redirection to ensure localStorage is cleared
            setTimeout(() => {
                window.location.replace("/affiliate/login");
            }, 100); // Small delay (100ms)
        };

        // Fetch data only if token exists and not on login page
        if (token && location !== "/affiliate/login") {
            fetchData();
        } else if(location !== "/affiliate/login") {
            handleLogout();
        }
    }, [update]); // No need for `token` in the dependency array as it's being read outside of the effect

    return (
        <MyContext.Provider value={{ data, loading, setUpdate }}>
            {children}
        </MyContext.Provider>
    );
};

export const token = localStorage.getItem("token");