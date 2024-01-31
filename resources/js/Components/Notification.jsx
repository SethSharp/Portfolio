import React, { useState, useEffect } from "react";
import { XMarkIcon, CheckCircleIcon } from "@heroicons/react/24/solid";

const Notification = ({ success, errors }) => {
    const [notifications, setNotifications] = useState([]);

    useEffect(() => {
        if (success) {
            setNotifications((prevNotifications) => [
                ...prevNotifications,
                {
                    icon: (
                        <CheckCircleIcon className="h-6 w-6 text-green-500" />
                    ),
                    heading: "Success",
                    messages: [success],
                },
            ]);
        }
    }, [success]);

    useEffect(() => {
        if (errors) {
            setNotifications((prevNotifications) => [
                ...prevNotifications,
                {
                    icon: <XMarkIcon className="h-6 w-6 text-red-500" />,
                    heading: "Error",
                    messages: Object.values(errors),
                },
            ]);
        }
    }, [errors]);

    useEffect(() => {
        if (notifications.length > 0) {
            const timerId = setTimeout(() => {
                setNotifications((prevNotifications) => [
                    ...prevNotifications.slice(1),
                ]);
            }, 4000);

            return () => clearTimeout(timerId);
        }
    }, [notifications]);

    const removeNotification = (index) => {
        setNotifications((prevNotifications) => [
            ...prevNotifications.slice(0, index),
            ...prevNotifications.slice(index + 1),
        ]);
    };

    return (
        <div className="pointer-events-none fixed inset-0 flex items-end px-4 py-6 sm:items-start sm:p-6">
            <div className="flex w-full flex-col items-center space-y-4 sm:items-end">
                {notifications.map((notification, index) => (
                    <div
                        key={index}
                        className="pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5"
                    >
                        <div className="p-4">
                            <div className="flex items-start">
                                <div className="flex-shrink-0">
                                    {notification.icon}
                                </div>
                                <div className="ml-3 w-0 flex-1 pt-0.5">
                                    <p className="text-sm font-medium text-gray-900">
                                        {notification.heading}
                                    </p>
                                    {notification.messages.map(
                                        (message, messageIndex) => (
                                            <p
                                                key={messageIndex}
                                                className="mt-1 text-sm text-gray-500"
                                            >
                                                {message}
                                            </p>
                                        ),
                                    )}
                                    <div className="mt-3 flex space-x-7">
                                        <button
                                            onClick={() =>
                                                removeNotification(index)
                                            }
                                            type="button"
                                            className="rounded-md bg-white text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                        >
                                            Dismiss
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                ))}
            </div>
        </div>
    );
};

export default Notification;
