import React, { useEffect } from "react";
import { LoginButton } from "@telegram-auth/react";
import { message } from "antd";

const LoginBox = () => {
    useEffect(() => {
        async function Loginc() {
            const token = await localStorage.getItem("token"); 
            if (token) {
                window.location.replace("/affiliate");
            }
        }
        Loginc();
    }, []);

    const handleAuthCallback = async (data) => {
        message.loading("Verifying login credentials...", 1);
        try {
            const response = await fetch("https://fastback.in/api/register", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            });

            const result = await response.json();

            if (result.status === "login") {
                message.success("Login successful");
                localStorage.setItem("token", data.hash);
                setTimeout(() => {
                    window.location.replace("/affiliate");
                }, 2000);
            } else if (result.status === "register") {
                message.success("Registration successful");
                localStorage.setItem("token", data.hash);
                setTimeout(() => {
                    window.location.replace("/affiliate");
                }, 2000);
            } else if (result.status === "server") {
                message.error(JSON.stringify(result));
            } else {
                message.error("Invalid login credentials");
            }
        } catch (error) {
            message.error("Error occurred during login");
            console.error("Error:", error);
        }
    };

    return (
        <div className="relative py-16 bg-gradient-to-br from-sky-50 min-h-screen to-gray-200">
            <div className="relative container m-auto px-6 text-gray-500 md:px-12 xl:px-40">
                <div className="m-auto md:w-8/12 lg:w-6/12 xl:w-6/12">
                    <div className="rounded-xl bg-white shadow-xl">
                        <div className="p-6 sm:p-16">
                            <div className="space-y-4">
                                <img 
                                    src="https://fastback.in/logo.png" 
                                    alt="Logo" 
                                    className="w-24 m-auto" 
                                    loading="lazy"
                                />
                                <h2 className="mb-8 text-md text-center text-cyan-900 font-bold">
                                    Sign in to unlock the best of Fastback.
                                </h2>
                            </div>
                            <div className="mt-16 grid space-y-4">
                                <div className="flex items-center justify-center">
                                    <LoginButton
                                        style={{ margin: "auto" }}
                                        botUsername={"fastbackrbot"}
                                        onAuthCallback={handleAuthCallback}
                                    />
                                </div>
                            </div>
                            <div className="mt-32 space-y-4 text-gray-600 text-center sm:-mb-8">
                                <p className="text-xs">
                                    By logging in or registering, you agree to our{" "}
                                    <a href="/terms" className="underline">Terms of Use</a> and confirm you have read our{" "}
                                    <a href="/privacy" className="underline">Privacy and Cookie Statement</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default LoginBox;