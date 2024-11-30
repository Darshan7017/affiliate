import React from "react";
import { Icon } from "@iconify/react";

export default function Card({ data, icon, bg, head }) {
    return (
        <div className="m-6">
            <div className="flex flex-wrap -mx-6">
                <div className="w-full px-6">
                    <div className="flex items-center px-3 py-4 shadow-sm rounded-md bg-slate-100">
                        <div className={`p-3 rounded-full ${bg} bg-opacity-75`}>
                            <Icon
                                icon={icon}
                                width="32"
                                height="32"
                                style={{ color: "white" }}
                            />
                        </div>
                        <div className="mx-5">
                            <h6 className="text-sm font-semibold text-gray-700">
                                {head}
                            </h6>
                            <div className="font-bold text-md">{data}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
