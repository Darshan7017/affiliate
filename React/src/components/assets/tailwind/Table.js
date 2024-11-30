import React from "react";

const Table = ({ head, headers, data, maxHeight }) => {
  return (
    <>
      <div className="p-4 bg-white rounded-lg border m-6">
        <h2 className="text-xl font-semibold mb-4">{head}</h2>
        <div className="overflow-y-auto" style={{ maxHeight: `${maxHeight}px` }}>
          <table className="min-w-full table-auto border-collapse h-10">
            <thead className="bg-gray-200">
              <tr>
                {headers.map((header, index) => (
                  <th key={index} className="border px-4 py-2">{header}</th>
                ))}
              </tr>
            </thead>
            <tbody>
              {data.map((row, index) => (
                <tr key={index} className="bg-white">
                  {row.map((cell, cellIndex) => (
                    <td key={cellIndex} className="border px-4 py-2">{cell}</td>
                  ))}
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </>
  );
};

export default Table;