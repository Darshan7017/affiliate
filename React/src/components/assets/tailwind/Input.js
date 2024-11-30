import React from "react";
import { Icon } from "@iconify/react";

export default function Input({ icon, label, type, value, onChange, readOnly, className, ...props }) {
  return (
    <div className={`relative ${className}`}>
      <input
        type={type}
        className="peer py-3 px-4 ps-11 block w-full bg-gray-50 border rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none mt-2 outline-blue-500"
        placeholder={label}
        value={value}
        onChange={onChange}
        readOnly={readOnly ?? false} 
        {...props}
      />
      <div className="absolute inset-y-0 left-0 flex items-center pointer-events-none pl-4">
        <Icon
          icon={icon}
          className="text-gray-500"
        />
      </div>
    </div>
  );
}