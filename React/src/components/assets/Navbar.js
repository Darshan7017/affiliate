import React from "react";
import { Icon } from "@iconify/react";
import { Link, useLocation } from "react-router-dom";

export default function Navbar() {
  const { pathname: path } = useLocation();
  
    return (
        <>
            <div className="fixed bottom-0 left-0 z-50 w-full h-16 bg-white border-t rounded-t-xl border-gray-200">
                <div className="grid h-full max-w-lg grid-cols-4 mx-auto font-medium">
                    <Link
                        to="/affiliate"
                        className="inline-flex flex-col items-center justify-center px-5 group"
                    >
                        <Icon
                            icon="carbon:home"
                            className={`w-6 h-6 ${path === '/affiliate' ? 'text-blue-600' : 'text-gray-500'}`}
                        />
                        <span className={`text-sm ${path === '/affiliate' ? 'text-blue-600' : 'text-gray-500'} mb-1`}>
                            Home
                        </span>
                    </Link>
                    <Link
                        to="/affiliate/offers"
                        className="inline-flex flex-col items-center justify-center px-5 group"
                    >
                        <Icon
                            icon="solar:gift-linear"
                            className={`w-6 h-6 ${path === '/affiliate/offers' ? 'text-blue-600' : 'text-gray-500'}`}
                        />
                        <span className={`text-sm ${path === '/affiliate/offers' ? 'text-blue-600' : 'text-gray-500'} mb-1`}>
                            Offers
                        </span>
                    </Link>
                    <Link
                        to="/affiliate/report"
                        className="inline-flex flex-col items-center justify-center px-5 group"
                    >
                        <Icon
                            icon="tabler:report-money"
                            className={`w-7 h-7 ${path === '/affiliate/report' ? 'text-blue-600' : 'text-gray-500'}`}
                        />
                        <span className={`text-sm ${path === '/affiliate/report' ? 'text-blue-600' : 'text-gray-500'} mb-1`}>
                            Report
                        </span>
                    </Link>
                    <Link
                        to="/affiliate/profile"
                        className="inline-flex flex-col items-center justify-center px-5 group"
                    >
                        <Icon
                            icon="gg:profile"
                            className={`w-7 h-7 ${path === '/affiliate/profile' ? 'text-blue-600' : 'text-gray-500'}`}
                        />
                        <span className={`text-sm ${path === '/affiliate/profile' ? 'text-blue-600' : 'text-gray-500'} mb-0.5`}>
                            Profile
                        </span>
                    </Link>
                </div>
            </div>
        </>
    );
}
