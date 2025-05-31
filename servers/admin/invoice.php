<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techmin Invoice</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
        }

        /* Print styles */
        @media print {
            body {
                background: white !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .no-print {
                display: none !important;
            }

            .invoice-container {
                box-shadow: none !important;
                border-radius: 0 !important;
                margin: 0 !important;
                max-width: 100% !important;
            }

            .print-break {
                page-break-inside: avoid;
            }

            /* Ensure good contrast for printing */
            .text-gray-600 {
                color: #374151 !important;
            }

            .text-gray-700 {
                color: #374151 !important;
            }

            /* A4 size adjustments */
            .a4-size {
                width: 210mm;
                min-height: 297mm;
                padding: 20mm;
            }

            /* Letter size adjustments */
            .letter-size {
                width: 8.5in;
                min-height: 11in;
                padding: 1in;
            }

            /* Legal size adjustments */
            .legal-size {
                width: 8.5in;
                min-height: 14in;
                padding: 1in;
            }
        }

        /* Size preview classes */
        .size-small {
            transform: scale(0.8);
            transform-origin: top left;
        }

        .size-medium {
            transform: scale(1);
        }

        .size-large {
            transform: scale(1.2);
            transform-origin: top left;
        }

        /* Loading spinner */
        .loading-spinner {
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Editable fields */
        .editable {
            transition: all 0.2s ease;
            padding: 2px 4px;
            border-radius: 3px;
        }

        .editable:hover {
            background-color: #f3f4f6;
            cursor: text;
        }

        .editable:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 1px;
            background-color: white;
        }

        /* Validation styles */
        .invalid {
            border: 1px solid #ef4444;
            background-color: #fef2f2;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.75rem;
            margin-top: 2px;
        }
    </style>
</head>

<body class="bg-gray-50 p-4 md:p-8">
    <!-- Print Controls -->
    <div class="no-print max-w-4xl mx-auto mb-4 bg-white p-6 rounded-xl shadow-lg">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <!-- Left: Print Options -->
            <div class="flex flex-wrap items-center gap-4">
                <h3 class="w-full font-semibold text-lg text-gray-800">Print Options</h3>

                <div class="flex items-center space-x-2">
                    <label for="paperSize" class="text-sm text-gray-700">Paper Size:</label>
                    <select id="paperSize"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none">
                        <option value="a4">A4</option>
                        <option value="letter">Letter</option>
                        <option value="legal">Legal</option>
                    </select>
                </div>

                <div class="flex items-center space-x-2">
                    <label for="scaleSize" class="text-sm text-gray-700">Scale:</label>
                    <select id="scaleSize"
                        class="border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none">
                        <option value="small">80%</option>
                        <option value="medium" selected>100%</option>
                        <option value="large">120%</option>
                    </select>
                </div>

                <div class="flex items-center space-x-2">
                    <label for="editMode" class="text-sm text-gray-700">Edit Mode:</label>
                    <input type="checkbox" id="editMode"
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500" />
                </div>
            </div>

            <!-- Right: Action Buttons -->
            <div class="flex flex-wrap justify-start md:justify-end gap-2">
                <button
                    class="flex items-center px-4 py-2 border border-blue-500 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors duration-200 space-x-2"
                    aria-label="Print Invoice">
                    <i class="bi bi-printer"></i>
                    <span class="text-sm font-medium">Print Invoice</span>
                </button>

                <button id="pdfButton"
                    class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200 space-x-2"
                    aria-label="Download PDF">
                    <div id="pdfSpinner" class="hidden loading-spinner"></div>
                    <svg id="pdfIcon" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span id="pdfText" class="text-sm font-medium">Download PDF</span>
                </button>
            </div>
        </div>
    </div>



    <div id="invoiceContainer"
        class="invoice-container max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden size-medium">
        <!-- Header -->
        <div class="bg-white px-6 py-8 border-b border-gray-200 print-break">
            <div class="flex justify-between items-start">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path
                                d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z" />
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 editable" contenteditable="false"
                        data-field="companyName">Techmin</h1>
                </div>
                <div class="text-right">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">Invoice</h2>
                </div>
            </div>
        </div>

        <!-- Invoice Details -->
        <div class="px-6 py-6">
            <div class="mb-8">
                <p class="text-lg font-medium text-gray-900 mb-2">Hello, <span class="editable" contenteditable="false"
                        data-field="clientName">Thomson</span></p>
                <p class="text-gray-600 max-w-2xl editable" contenteditable="false" data-field="description">
                    Please find below a cost-breakdown for the recent work completed. Please make payment at your
                    earliest convenience, and do not hesitate to contact me with any questions.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 print-break">
                <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Billing Address -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-3">Billing Address
                        </h3>
                        <div class="text-gray-700 space-y-1">
                            <p class="font-medium editable" contenteditable="false" data-field="billingName">Lynne K.
                                Higby</p>
                            <p class="editable" contenteditable="false" data-field="billingAddress1">795 Folsom Ave,
                                Suite 600</p>
                            <p class="editable" contenteditable="false" data-field="billingAddress2">San Francisco, CA
                                94107</p>
                            <p class="editable" contenteditable="false" data-field="billingPhone">P: (123) 456-7890</p>
                        </div>
                    </div>

                    <!-- Shipping Address -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-3">Shipping Address
                        </h3>
                        <div class="text-gray-700 space-y-1">
                            <p class="font-medium editable" contenteditable="false" data-field="shippingName">Amy
                                Dickson</p>
                            <p class="editable" contenteditable="false" data-field="shippingAddress1">795 Folsom Ave,
                                Suite 600</p>
                            <p class="editable" contenteditable="false" data-field="shippingAddress2">San Francisco, CA
                                94107</p>
                            <p class="editable" contenteditable="false" data-field="shippingPhone">P: (123) 456-7890</p>
                        </div>
                    </div>
                </div>

                <!-- Order Details -->
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-semibold text-gray-900 mb-1">Order Date:</p>
                        <p class="text-gray-700 editable" contenteditable="false" data-field="orderDate">Jan 17, 2023
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 mb-1">Order Status:</p>
                        <span
                            class="inline-flex px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full editable"
                            contenteditable="false" data-field="orderStatus">Paid</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 mb-1">Order ID:</p>
                        <p class="text-gray-700 font-mono editable" contenteditable="false" data-field="orderId">#123456
                        </p>
                    </div>
                </div>
            </div>

            <!-- Items Table -->
            <div class="overflow-x-auto print-break">
                <table class="w-full" id="itemsTable">
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
                            <th class="text-center py-3 px-2 font-semibold text-gray-900 text-sm uppercase tracking-wide no-print"
                                id="actionHeader" style="display: none;">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="itemsBody">
                        <!-- Items will be populated by JavaScript -->
                    </tbody>
                </table>
                <button id="addItemBtn"
                    class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 no-print"
                    style="display: none;">
                    Add Item
                </button>
            </div>

            <!-- Summary -->
            <div class="flex justify-end mt-8 print-break">
                <div class="w-full max-w-sm">
                    <div class="space-y-3" id="summarySection">
                        <!-- Summary will be populated by JavaScript -->
                    </div>
                </div>
            </div>

            <!-- Notes -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-sm font-semibold text-gray-900 mb-3">Notes:</h3>
                <p class="text-sm text-gray-600 leading-relaxed editable" contenteditable="false" data-field="notes">
                    All accounts are to be paid within 7 days from receipt of invoice. To be paid by cheque or credit
                    card or direct payment online.
                    If account is not paid within 7 days the credits details supplied as confirmation of work undertaken
                    will be charged the agreed quoted fee noted above.
                </p>
            </div>
        </div>
    </div>
</body>

</html>