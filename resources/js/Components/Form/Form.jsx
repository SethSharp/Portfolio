import React from "react";

export default function Form({ children }) {
    const contentSlot = React.Children.toArray(children).filter(
        (child) => child.props.slot === "content",
    );

    const actionsSlot = React.Children.toArray(children).filter(
        (child) => child.props.slot === "actions",
    );

    return (
        <div className="w-3/4 p-8">
            <div className="">{contentSlot}</div>

            <div className="mt-6">{actionsSlot}</div>
        </div>
    );
}
