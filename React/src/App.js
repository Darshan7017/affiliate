import React from "react";
import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import Login from "./components/Login";
import { Userdata as Data } from "./components/assets/Data";
import Home from "./components/Home"; 
import Offers from "./components/Offers";
import Report from "./components/Report";
import Profile from "./components/Profile";

export default function App() {
    return (
        <Data>
            <Router>
                <Routes>
                    <Route path="/affiliate" element={<Home />} />
                    <Route path="/affiliate/" element={<Home />} />
                    <Route path="/affiliate/login" element={<Login />} />
                    <Route path="/affiliate/offers" element={<Offers />} />
                    <Route path="/affiliate/report" element={<Report />} />
                    <Route path="/affiliate/profile" element={<Profile />} />
                </Routes>
            </Router>
        </Data>
    );
}
