<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techmin Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 p-4 md:p-8">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-white px-6 py-8 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Techmin</h1>
                </div>
                <div class="text-right">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Invoice</h2>
                </div>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="px-6 py-6">
            <div class="mb-8">
                <p class="text-lg font-medium text-gray-900 mb-2">Hello, Thomson</p>
                <p class="text-gray-600 max-w-2xl">
                    Please find below a cost-breakdown for the recent work completed. Please make payment at your
                    earliest convenience, and do not hesitate to contact me with any questions.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Billing Address -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-3">Billing Address
                        </h3>
                        <div class="text-gray-700 space-y-1">
                            <p class="font-medium">Lynne K. Higby</p>
                            <p>795 Folsom Ave, Suite 600</p>
                            <p>San Francisco, CA 94107</p>
                            <p>P: (123) 456-7890</p>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-3">Shipping Address
                        </h3>
                        <div class="text-gray-700 space-y-1">
                            <p class="font-medium">Amy Dickson</p>
                            <p>795 Folsom Ave, Suite 600</p>
                            <p>San Francisco, CA 94107</p>
                            <p>P: (123) 456-7890</p>
                        </div>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-900 mb-1">Order Date:</p>
                        <p class="text-gray-700">Jan 17, 2023</p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 mb-1">Order Status:</p>
                        <span
                            class="inline-flex px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Paid</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 mb-1">Order ID:</p>
                        <p class="text-gray-700 font-mono">#123456</p>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="text-left py-3 px-2 font-semibold text-gray-900 text-sm uppercase tracking-wide">
                                #</th>
                            <th class="text-left py-3 px-2 font-semibold text-gray-900 text-sm uppercase tracking-wide">
                                Item</th>
                            <th
                                class="text-center py-3 px-2 font-semibold text-gray-900 text-sm uppercase tracking-wide">
                                Quantity</th>
                            <th
                                class="text-right py-3 px-2 font-semibold text-gray-900 text-sm uppercase tracking-wide">
                                Unit Cost</th>
                            <th
                                class="text-right py-3 px-2 font-semibold text-gray-900 text-sm uppercase tracking-wide">
                                Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-2 text-gray-900 font-medium">1</td>
                            <td class="py-4 px-2">
                                <div>
                                    <p class="font-semibold text-gray-900">Laptop</p>
                                    <p class="text-sm text-gray-600">Brand Model VGN-TXN27N/B 11.1" Notebook PC</p>
                                </div>
                            </td>
                            <td class="py-4 px-2 text-center text-gray-900">1</td>
                            <td class="py-4 px-2 text-right text-gray-900 font-medium">$1799.00</td>
                            <td class="py-4 px-2 text-right text-gray-900 font-semibold">$1799.00</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-2 text-gray-900 font-medium">2</td>
                            <td class="py-4 px-2">
                                <div>
                                    <p class="font-semibold text-gray-900">Warranty</p>
                                    <p class="text-sm text-gray-600">Two Year Extended Warranty - Parts and Labor</p>
                                </div>
                            </td>
                            <td class="py-4 px-2 text-center text-gray-900">3</td>
                            <td class="py-4 px-2 text-right text-gray-900 font-medium">$499.00</td>
                            <td class="py-4 px-2 text-right text-gray-900 font-semibold">$1497.00</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-2 text-gray-900 font-medium">3</td>
                            <td class="py-4 px-2">
                                <div>
                                    <p class="font-semibold text-gray-900">LED</p>
                                    <p class="text-sm text-gray-600">80cm (32) HD Ready LED TV</p>
                                </div>
                            </td>
                            <td class="py-4 px-2 text-center text-gray-900">2</td>
                            <td class="py-4 px-2 text-right text-gray-900 font-medium">$412.00</td>
                            <td class="py-4 px-2 text-right text-gray-900 font-semibold">$824.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Summary -->
            <div class="flex justify-end mt-8">
                <div class="w-full max-w-sm">
                    <div class="space-y-3">
                        <div class="flex justify-between py-2">
                            <span class="text-gray-700 font-medium">Sub-total:</span>
                            <span class="text-gray-900 font-semibold">$4120.00</span>
                        </div>
                        <div class="flex justify-between py-2">
                            <span class="text-gray-700 font-medium">VAT (12.5):</span>
                            <span class="text-gray-900 font-semibold">$515.00</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between">
                                <span class="text-xl font-bold text-gray-900">Total:</span>
                                <span class="text-2xl font-bold text-gray-900">$4635.00 USD</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">Notes:</h3>
                <p class="text-sm text-gray-600 leading-relaxed">
                    All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or credit
                    card or direct payment online.
                    If account is not paid within 7 days the credits details supplied as confirmation of work undertaken
                    will be charged the agreed quoted fee noted above.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200">
                <button
                    class="px-6 py-2 border border-blue-500 text-blue-500 rounded-lg hover:bg-blue-50 transition-colors duration-200 flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Print</span>
                </button>
                <button
                    class="px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-200">
                    Submit
                </button>
            </div>
        </div>
    </div>
</body>

</html>