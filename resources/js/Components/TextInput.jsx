import { forwardRef, useEffect, useRef } from "react";
import InputLabel from "@/Components/InputLabel.jsx";

export default forwardRef(function TextInput(
    { type = "text", label = "", className = "", isFocused = false, ...props },
    ref,
) {
    const input = ref ? ref : useRef();

    useEffect(() => {
        if (isFocused) {
            input.current.focus();
        }
    }, []);

    return (
        <div className="my-1">
            <InputLabel value={label} />

            <input
                {...props}
                type={type}
                className={
                    "border-gray-300 p-2 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm " +
                    className
                }
                ref={input}
            />
        </div>
    );
});
