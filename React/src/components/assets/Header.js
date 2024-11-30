import React from "react";
import { useData } from "./Data";

export default function Header() {
    const { data, loading } = useData();
    return (
        <header className="border-b font-[sans-serif]">
            <div className="flex flex-wrap items-center px-10 py-4 relative bg-white min-h-[60px]">
                <a href="/" className="hidden max-lg:block">
                    <img src="https://fastback.in/logo.png" alt="logo" className="w-28" />
                </a>
                <div className="flex ml-auto lg:order-1 lg:hidden">
                    {loading ? (
                        <div role="status" class="animate-pulse">
                            <svg
                                class="w-10 h-10 text-gray-200 me-4"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                            >
                                <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                            </svg>
                        </div>
                    ) : (
                        data.photo && (
                            <img
                                src={data.photo}
                                alt="user"
                                className="w-10 h-10 rounded-full"
                            />
                        )
                    )}
                </div>
            </div>
        </header>
    );
}
