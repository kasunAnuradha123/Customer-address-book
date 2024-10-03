import { useState } from "react";
import NavLink from "@/Components/NavLink";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import Modal from "@/Components/Modal";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";

export default function Customer({ customers }: { customers: any }) {
    
    const [expandedCustomers, setExpandedCustomers] = useState<number[]>([]);
    const [isModalOpen, setIsModalOpen] = useState(false);

    const openModal = () => {
        setIsModalOpen(true);
    };

    const closeModal = () => {
        setIsModalOpen(false);
    };

    const toggleCustomer = (id: number) => {
        if (expandedCustomers.includes(id)) {
            setExpandedCustomers(
                expandedCustomers.filter((customerId) => customerId !== id)
            );
        } else {
            setExpandedCustomers([...expandedCustomers, id]);
        }
    };

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Customer
                </h2>
            }
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="mt-2 text-end mr-4">
                            <button
                                className="px-4 py-2 bg-blue-500 text-white rounded-md"
                                onClick={openModal}
                            >
                                Create Customer
                            </button>
                        </div>
                        <Modal
                            show={isModalOpen}
                            onClose={closeModal}
                            maxWidth="lg"
                        >
                            <div className="p-6">
                                <h3 className="text-lg font-medium text-gray-900">
                                    Create New Customer
                                </h3>
                                <form>
                                    <div className="mt-4">
                                        {/* <InputLabel className="block text-sm font-medium text-gray-700">
                                            Name
                                        /> */}
                                        <InputLabel
                                            value="Name"
                                        />
                                        <TextInput
                                            type="text"
                                            className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            placeholder="Enter Name"

                                        />
                                    </div>
                                    <div className="mt-4">
                                        <label className="block text-sm font-medium text-gray-700">
                                            Company
                                        </label>
                                        <input
                                            type="text"
                                            className="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        />
                                    </div>
                                    <div className="mt-4">
                                        <button
                                            type="submit"
                                            className="inline-flex justify-center px-4 py-2 bg-blue-600 text-white rounded-md"
                                        >
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </Modal>

                        <div className="p-6 text-gray-900">
                            <table className="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Name
                                        </th>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Company
                                        </th>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Phone Number
                                        </th>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Country
                                        </th>
                                        <th className="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody className="bg-white divide-y divide-gray-200">
                                    {customers.map((customer: any) => (
                                        <>
                                            <tr key={customer.id}>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <div className="flex items-center">
                                                        <div className="ml-4">
                                                            <div className="text-sm font-medium text-gray-900">
                                                                {customer.name}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <div className="text-sm text-gray-900">
                                                        {customer.company}
                                                    </div>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <div className="text-sm text-gray-900">
                                                        {customer.phone_number}
                                                    </div>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <div className="text-sm text-gray-900">
                                                        {customer.email}
                                                    </div>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <div className="text-sm text-gray-900">
                                                        {customer.country}
                                                    </div>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <button
                                                        onClick={() =>
                                                            toggleCustomer(
                                                                customer.id
                                                            )
                                                        }
                                                        className="text-indigo-600 hover:text-indigo-900"
                                                    >
                                                        {expandedCustomers.includes(
                                                            customer.id
                                                        )
                                                            ? "Hide Addresses"
                                                            : "Show Addresses"}
                                                    </button>
                                                </td>
                                            </tr>
                                            {expandedCustomers.includes(
                                                customer.id
                                            ) &&
                                                customer?.address.map(
                                                    (add: any, index: any) => (
                                                        <tr
                                                            key={`${customer.id}-${index}`}
                                                        >
                                                            <td className="px-6 py-4 whitespace-nowrap"></td>
                                                            <td className="px-6 py-4 whitespace-nowrap">
                                                                <div className="text-sm text-gray-900">
                                                                    Address{" "}
                                                                    {index + 1}
                                                                </div>
                                                            </td>
                                                            <td className="px-6 py-4 whitespace-nowrap">
                                                                <div className="text-sm text-gray-900">
                                                                    {
                                                                        add?.number
                                                                    }
                                                                </div>
                                                            </td>
                                                            <td className="px-6 py-4 whitespace-nowrap">
                                                                <div className="text-sm text-gray-900">
                                                                    {add?.city}
                                                                </div>
                                                            </td>
                                                            <td className="px-6 py-4 whitespace-nowrap">
                                                                <div className="text-sm text-gray-900">
                                                                    {
                                                                        add?.street
                                                                    }
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    )
                                                )}
                                        </>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
