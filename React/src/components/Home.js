import React, { useState, useEffect } from "react";
import Header from "./assets/Header";
import Navbar from "./assets/Navbar";
import Card from "./assets/Card";
import Table from "./assets/tailwind/Table";
import { token } from "./assets/Data"; // Assuming `token` is exported from `Data`

const Home = () => {
  const headers = ["Offer", "Conversions", "Clicks"];
  
  const [offers, setOffers] = useState([]);
  const [clicks, setClicks] = useState(0);
  const [conversions, setConversions] = useState(0);
  const [isLoading, setIsLoading] = useState(true);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch(`https://fastback.in/api/ccd?token=${token}`);
        const result = await response.json();
        if (result.status === "success") {
          setOffers(result.data);  // Set offer data
          setClicks(result.clicks);  // Set total clicks
          setConversions(result.conversions);  // Set total conversions
        }
      } catch (error) {
        console.error("Error fetching data:", error);
      } finally {
        setIsLoading(false);  // Loading complete
      }
    };
 
    fetchData();
  }, []);

  // Map the fetched offers data to table format
  const offerData = offers.map((offer) => [
    offer.offerName,
    offer.leads.toString(),  // Convert to string for display
    offer.clicks.toString()
  ]);

  // Skeleton loader for table rows
  const skeletonData = Array(4).fill([
    <div className="h-4 bg-gray-300 rounded animate-pulse"></div>,
    <div className="h-4 bg-gray-300 rounded animate-pulse"></div>,
    <div className="h-4 bg-gray-300 rounded animate-pulse"></div>,
  ]);

  return (
    <div>
      <Header />
      <Card
        icon="clarity:cursor-hand-click-line"
        head="Today Clicks"
        data={isLoading ? "..." : clicks}  // Show clicks dynamically or loading indicator
        bg="bg-cyan-500"
      />
      <Card
        icon="hugeicons:payment-success-01"
        head="Today Conversion"
        data={isLoading ? "..." : conversions}  // Show conversions dynamically or loading indicator
        bg="bg-green-400"
      />
      {isLoading ? (
        <Table head="Offer Data" headers={headers} data={skeletonData} maxHeight={250} />
      ) : (
        <Table head="Offer Data" headers={headers} data={offerData} maxHeight={250} />
      )}
      <Navbar />
    </div>
  );
};

export default Home;