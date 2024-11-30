import React from "react";
import { Link } from "react-router-dom";

function Toggle({ label, onChange }) {
    return (
        <div class="flex items-center mt-2">
            <label class="relative cursor-pointer">
                <input
                    type="checkbox"
                    class="sr-only peer"
                    onChange={onChange}
                />
                <div class="w-[53px] h-7 flex items-center bg-red-500 rounded-full text-[9px] peer-checked:text-[#007bff] text-black font-extrabold after:flex after:items-center after:justify-center peer after:content-['Off'] peer-checked:after:content-['On'] peer-checked:after:translate-x-full after:absolute after:left-[2px] peer-checked:after:border-white after:bg-white after:border after:border-gray-300 after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-[#37e158]"></div>
            </label>
            <p class="ml-2 text-sm font-medium text-gray-900">{label} {label === "Advance" && <span>: <Link to='/profile' className='text-sky-500'>Click Here</Link> To Add / Update Channels</span>} </p>
        </div>
    );
}

export default Toggle;
