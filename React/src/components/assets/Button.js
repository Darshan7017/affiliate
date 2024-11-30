import React from "react";
import { Icon } from "@iconify/react";

export default function Button({ text, icon, onClick }) {
    return (
        <div className=" flex items-center bg-gray-100 p-5 rounded-md mt-3 w-10/12 m-auto" onClick={onClick} >
            <span className="icon shadow-inner p-2 rounded-full flex-shrink-0 mr-5 bg-gray-100">
                <Icon icon={icon} width="24" />
            </span>
            <p className="mt-0 flex-1 font-semibold capitalize">{text}</p>
            <span className="ml-auto shadow-inner p-2 rounded-full bg-gray-100">
                    <Icon icon="iconamoon:arrow-right-2-light" width="24" />
            </span>
        </div>
    );
}
