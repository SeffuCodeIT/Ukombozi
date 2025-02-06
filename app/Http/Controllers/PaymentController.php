<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Safaricom\Mpesa\Mpesa;
class   PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function pesapalAccessToken(Request $request)
    {
        $payment = new Payment();
        return $payment->pesapalAccessToken();
    }

    public function registerPesapalIPN(Request $request)
    {
        $payment = new Payment();
        return $payment->registerPesapalIPN();
    }

    public function pesapalIPN()
    {
        header("Content-Type: application/json");
        $pinCallbackResponse = file_get_contents('php://input');
        $logFile = "pesapalCallback.json";
        $log = fopen($logFile, "a");
        fwrite($log, $pinCallbackResponse);
        fclose($log);
    }

    public function getRegisteredIPNs(Request $request)
    {
        $payment = new Payment();
        return $payment->getRegisteredIPNs();
    }

    public function submitOrderRequest(Request $request)
    {
        $payment = new Payment();
        $order = $payment->submitOrderRequest($request->all());
        $order = json_decode($order, true);
        return redirect($order["redirect_url"]);
    }

    public function paymentSuccess(Request $request)
    {
        $payment = new Payment();

        // Get the transaction status from the Payment model
        $transactionData = $payment->getTransactionStatus($request);

        if (isset($transactionData['status']) && $transactionData['status'] === '200') {
            // Ensure payment was completed successfully
            if ($transactionData['payment_status_description'] === 'Completed') {
                // Save the order in the database
                Orders::create([
                    'first_name' => $request->input('first_name'),
                    'country' => $request->input('country'),
                    'county' => $request->input('county'),
                    'constituency' => $request->input('constituency'),
                    'street_address' => $request->input('street_address'),
                    'landmark' => $request->input('landmark', null),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'total' => $transactionData['amount'], // Marked as "amount" in API response
                    'product_id' => $request->input('product_id'),
                    'product_qty' => $request->input('product_qty'),
                    'shipping_method' => $request->input('shipping_method'), // 0 = Pickup, 1 = Delivery
                    'payment_status' => $transactionData['payment_status_description'],
                    'payment_id' => $transactionData['order_tracking_id'],
                    'confirmation_code' => $transactionData['confirmation_code'],
                    'account_no' => $transactionData['account_no'] ?? null, // Account number used
                    'failure_reason' => null, // No failure reason since it's successful
                ]);

                return redirect()->route('order.success')->with('message', 'Payment successful!');
            } else {
                // Handle unsuccessful payments
                Orders::create([
                    'first_name' => $request->input('first_name'),
                    'country' => $request->input('country'),
                    'county' => $request->input('county'),
                    'constituency' => $request->input('constituency'),
                    'street_address' => $request->input('street_address'),
                    'landmark' => $request->input('landmark', null),
                    'phone' => $request->input('phone'),
                    'email' => $request->input('email'),
                    'total' => $transactionData['amount'], // Amount attempted
                    'product_id' => $request->input('product_id'),
                    'product_qty' => $request->input('product_qty'),
                    'shipping_method' => $request->input('shipping_method'), // 0 = Pickup, 1 = Delivery
                    'payment_status' => $transactionData['payment_status_description'],
                    'payment_id' => $transactionData['order_tracking_id'],
                    'confirmation_code' => null, // No confirmation since it failed
                    'account_no' => $transactionData['account_no'] ?? null, // Account number used
                    'failure_reason' => $transactionData['message'] ?? 'Payment failed',
                ]);

                return redirect()->route('order.failure')->with('error', 'Payment not completed.');
            }
        } else {
            // Handle failed API calls
            return redirect()->route('order.failure')->with('error', 'Failed to process the payment.');
        }
    }



    public function refundRequest()
    {
        $payment = new Payment();
        return $payment->refundRequest();
    }
    public function orderCancellation()
    {
        $payment = new Payment();
        return $payment->orderCancellation();
    }

//    public function stk(Request $request)
//    {
//        // Validate the request
//        $request->validate([
//            'first_name' => 'required|string|max:255',
//            'country' => 'required|string|max:255',
//            'county' => 'required|string|max:255',
//            'constituency' => 'required|string|max:255',
//            'street_address' => 'required|string|max:255',
//            'landmark' => 'required|string|max:255',
//            'phone' => 'required|string|max:15',
//            'email' => 'required|email|max:255',
//            'total' => 'required|numeric',
//            'shipping_method' => 'required|string',
//        ]);
//
////        $phone = $request->phone;
////        if (substr($phone, 0, 1) === '0') {
////            $phone = '254' . substr($phone, 1);
////        } elseif (!str_starts_with($phone, '254')) {
////            $phone = '254' . $phone;
////        }
//        // M-Pesa API credentials and configuration
//        $BusinessShortCode = '174379';
//        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
//        $Timestamp = date('YmdHis');
//        $TransactionType = 'CustomerBuyGoodsOnline';
//        $Amount = $request->total;
//        $PartyA = $request->phone; // Customer's phone number
//        $PartyB = $BusinessShortCode; // M-Pesa Shortcode
//        $PhoneNumber = $request->phone;
//        $CallBackURL = 'http://192.168.43.241:8000/checkout'; // Update with your actual callback URL
//        $AccountReference = 'Order_' . time(); // Unique order reference
//        $TransactionDesc = 'Payment for Order';
//        $Remarks = 'Payment for Order #' . $AccountReference;
//
//        try {
//            $mpesa = new \Safaricom\Mpesa\Mpesa();
//
//            $stkPushSimulation = $mpesa->STKPushSimulation(
//                $BusinessShortCode,
//                $LipaNaMpesaPasskey,
//                $Timestamp,
//                $TransactionType,
//                $Amount,
//                $PartyA,
//                $PartyB,
//                $PhoneNumber,
//                $CallBackURL,
//                $AccountReference,
//                $TransactionDesc,
//                $Remarks);
//
//
//            dd($stkPushSimulation);
//            // Handle the response from M-Pesa
//            if (isset($stkPushSimulation['ResponseCode']) && $stkPushSimulation['ResponseCode'] == '0') {
//
////                $checkout_request_id = $stkPushSimulation->CheckoutRequestID;
//                // Payment initiation was successful; save order details
//                $order = new Payment();
//                $order->first_name = $request->first_name;
//                $order->country = $request->country;
//                $order->county = $request->county;
//                $order->constituency = $request->constituency;
//                $order->street_address = $request->street_address;
//                $order->landmark = $request->landmark;
//                $order->phone = $request->phone;
//                $order->email = $request->email;
//                $order->order_notes = $request->order_notes ?? '';
//                $order->total = $request->total;
//                $order->shipping_method = $request->shipping_method;
//                $order->payment_status = 'pending'; // Set as pending until confirmation
//                $order->payment_id = $stkPushSimulation['CheckoutRequestID'] ?? null; // Save the checkout request ID
//                $order->save();
//
//                // Redirect to a success page or show a success message
//                return redirect()->back()->with('success', 'Payment initiated successfully! Please complete the payment on your phone.');
//            } else {
//                // Payment initiation failed; return an error response
//                return redirect()->back()->withErrors('Payment failed. Please try again.');
//            }
//        } catch (\Exception $e) {
//            // Handle any exceptions that occur during the payment process
//            \Log::error('M-Pesa STK Push Error: ' . $e->getMessage());
//            return redirect()->back()->withErrors('An error occurred while processing your payment: ' . $e->getMessage());
//        }
//    }
    public function stkPush(Request $request)
    {
        // Log the incoming payment request
        Log::info('Received payment request:', $request->all());
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'county' => 'required|string|max:255',
            'constituency' => 'required|string|max:255',
            'street_address' => 'required|string|max:255',
            'landmark' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'total' => 'required|numeric',
            'shipping_method' => 'required|string',
        ]);

        $BusinessShortCode = '174379';
        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
//        $Timestamp = date('Y-m-d H:i:s');
        $TransactionType = 'CustomerPayBillOnline';
        $Amount = $request->total;
        $PartyA = $request->phone; // Customer's phone number
        $PartyB = $BusinessShortCode; // M-Pesa Shortcode
        $PhoneNumber = $request->phone;
        $CallBackURL = 'https://5171-102-0-208-65.ngrok-free.app/api/c2bCallback'; // Replace with your actual callback route
        $AccountReference = 'Order_' . time(); // Unique order reference
        $TransactionDesc = 'Payment for Order';
        $Remarks = 'Payment for Order #' . $AccountReference;

        $mpesa = new \Safaricom\Mpesa\Mpesa();

        $stkPushSimulation = $mpesa->STKPushSimulation(
            $BusinessShortCode,
            $LipaNaMpesaPasskey,
//            $Timestamp,
            $TransactionType,
            $Amount,
            $PartyA,
            $PartyB,
            $PhoneNumber,
            $CallBackURL,
            $AccountReference,
            $TransactionDesc,
            $Remarks
        );
//        dd($stkPushSimulation);

        $stkPushSimulation = json_decode($stkPushSimulation, true); // Decodes to an associative array

        // Log the response from the STK Push API
        Log::info('STK Push Response: ', (array) $stkPushSimulation);
        if (isset($stkPushSimulation) && $stkPushSimulation['ResponseCode'] == '0') {
            // Payment initiation was successful; save order details
            $order = new Payment();
            $order->first_name = $request->first_name;
            $order->country = $request->country;
            $order->county = $request->county;
            $order->constituency = $request->constituency;
            $order->street_address = $request->street_address;
            $order->landmark = $request->landmark;
            $order->phone = $request->phone;
            $order->email = $request->email;
            $order->total = $request->total;
            $order->shipping_method = $request->shipping_method;
            $order->payment_status = 'pending'; // Set as pending until confirmation
            $order->payment_id = $stkPushSimulation['CheckoutRequestID']; // Save the checkout request ID
            $order->save();

            // Redirect to a success page or show a success message
            return redirect()->back()->with('success', 'Payment initiated successfully! Please complete the payment on your phone.');
        } else {
            // Payment initiation failed; return an error response
            return redirect()->back()->withErrors('Payment failed. Please try again.');
        }
    }


    public function c2bCallback()
    {
        $callbackJSONData = file_get_contents('php://input');

        // Log the received callback JSON
        Log::info('Received STK Callback: ' . $callbackJSONData);

        $jsonFile = fopen('c2bCallback.json', 'w');
        fwrite($jsonFile, $callbackJSONData);

        $json = json_decode($callbackJSONData);

        // Log if the JSON structure is not as expected
        if (!isset($json->Body->stkCallback)) {
            Log::error('Invalid STK Callback JSON structure: ' . $callbackJSONData);
            return response()->json(['ResultCode' => 1, 'ResultDesc' => 'Invalid Request']);
        }

        $CheckoutRequestID = $json->Body->stkCallback->CheckoutRequestID;
        $ResultCode = $json->Body->stkCallback->ResultCode;
        $CallbackMetadata = $json->Body->stkCallback->CallbackMetadata;

        $Amount = 0;
        $MpesaReceiptNumber = "";
        $PhoneNumber = "";
        $TransactionDate = "";

        foreach ($CallbackMetadata->Item as $item) {
            if ($item->Name == "Amount") {
                $Amount = $item->Value;
            } else if ($item->Name == "MpesaReceiptNumber") {
                $MpesaReceiptNumber = $item->Value;
            } else if ($item->Name == "PhoneNumber") {
                $PhoneNumber = $item->Value;
            } else if ($item->Name == "TransactionDate") {
                $TransactionDate = $item->Value;
            }
        }

        // Log the parsed callback details
        Log::info("STK Callback Parsed: CheckoutRequestID=$CheckoutRequestID, ResultCode=$ResultCode, Amount=$Amount, MpesaReceiptNumber=$MpesaReceiptNumber, PhoneNumber=$PhoneNumber, TransactionDate=$TransactionDate");

        // Save to the database or handle the logic based on ResultCode

        return response()->json(['ResultCode' => 0, 'ResultDesc' => 'Callback received successfully']);
    }



//    public function stk()
//    {
//        //
//        $mpesa= new \Safaricom\Mpesa\Mpesa();
//
//           $BusinessShortCode = '174379';
//           $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
//           $Timestamp = "20160216165627";
//           $TransactionType = "CustomerPayBillOnline";
//           $Amount = "1";
//           $PartyA = "254708441307";
//           $PartyB = "174379";
//           $PhoneNumber = "254708441307";
//           $CallBackURL = "http://192.168.43.241:8000/mpesa/callback";
//           $AccountReference = "AccountReference";
//           $TransactionDesc = "TransactionDesc";
//           $Remarks = 'Remarks';
//
//        $stkPushSimulation=$mpesa->STKPushSimulation(
//            $BusinessShortCode,
//            $LipaNaMpesaPasskey,
//            $TransactionType,
//            $Amount,
//            $PartyA,
//            $PartyB,
//            $PhoneNumber,
//            $CallBackURL,
//            $AccountReference,
//            $TransactionDesc,
//            $Remarks);
//        dd($stkPushSimulation);
//    }
//    public function c2bCallgback()
//    {
//        // Get the callback JSON data from M-Pesa
//        $callBackJSONData = file_get_contents('php://input');
//        file_put_contents('mpesa_callback_log.txt', $callBackJSONData);
//        $callbackData = json_decode($callBackJSONData, true); // Convert JSON string to an associative array
//
//        // Check if stkCallback exists in the received data
//        if (isset($callbackData['Body']['stkCallback'])) {
//            $stkCallback = $callbackData['Body']['stkCallback'];
//
//            // Extract necessary fields from the callback
//            $checkoutRequestID = $stkCallback['CheckoutRequestID']; // Unique ID for the transaction
//            $resultCode = $stkCallback['ResultCode']; // Indicates whether the transaction was successful or not
//            $resultDesc = $stkCallback['ResultDesc']; // Description of the result (success or failure)
//
//            // Initialize variables
//            $mpesaReceiptNumber = null;
//            $transactionDate = null;
//            $amount = null;
//            $phoneNumber = null;
//
//            // If the result code is 0, it means the transaction was successful
//            if ($resultCode == 0 && isset($stkCallback['CallbackMetadata']['Item'])) {
//                // Loop through the Item array to get necessary fields
//                foreach ($stkCallback['CallbackMetadata']['Item'] as $item) {
//                    if ($item['Name'] == 'MpesaReceiptNumber') {
//                        $mpesaReceiptNumber = $item['Value'];
//                    }
//                    if ($item['Name'] == 'TransactionDate') {
//                        // Convert the TransactionDate to a readable format
//                        $transactionDate = \Carbon\Carbon::parse($item['Value'])->format('Y-m-d H:i:s');
//                    }
//                    if ($item['Name'] == 'Amount') {
//                        $amount = $item['Value'];
//                    }
//                    if ($item['Name'] == 'PhoneNumber') {
//                        $phoneNumber = $item['Value'];
//                    }
//                }
//
//                // Update the payment in the database
//                $payment = Payment::where('payment_id', $checkoutRequestID)->first();
//                if ($payment) {
//                    // Update the payment record
//                    $payment->payment_status = 'complete'; // Mark payment as complete
//                    $payment->mpesa_receipt_number = $mpesaReceiptNumber;
//                    $payment->payment_date = $transactionDate;
//                    $payment->save();
//                }
//
//            } else {
//                // Transaction failed, handle the failure case
//                $failureReason = $resultDesc; // Reason for failure
//
//                // Update the payment in the database
//                $payment = Payment::where('payment_id', $checkoutRequestID)->first();
//                if ($payment) {
//                    // Update the payment record
//                    $payment->payment_status = 'failed'; // Mark payment as failed
//                    $payment->failure_reason = $failureReason;
//                    $payment->save();
//                }
//            }
//
//            // Return a success response to M-Pesa
//            return response()->json(['status' => 'success'], 200);
//        } else {
//            // Return an error response if the callback data is not in the expected format
//            return response()->json(['error' => 'Invalid callback data'], 400);
//        }
//    }

//    public function c2bCallbackSeffu()
//    {
//        $callbackJSONData = file_get_contents('php://input');
////
//        $jsonFile = fopen('c2bCallback.json', 'w');
//        fwrite($jsonFile, $callbackJSONData);
//
//        $json = json_decode($callbackJSONData);
////
//        // Extract the CheckoutRequestID and ResultCode
//        $CheckoutRequestID = $json->Body->stkCallback->CheckoutRequestID;
//        $ResultCode = $json->Body->stkCallback->ResultCode;
//        $CallbackMetadata = $json->Body->stkCallback->CallbackMetadata;
//
//        $Amount = 0;
//        $MpesaReceiptNumber = "";
//        $PhoneNumber = "";
//        $TransactionDate = "";
//
//        foreach ($CallbackMetadata->Item as $item) {
//
//            if ($item->Name == "Amount") {
//                $Amount = $item->Value;
//            } else if ($item->Name == "MpesaReceiptNumber") {
//                $MpesaReceiptNumber = $item->Value;
//            } else if ($item->Name == "PhoneNumber") {
//                $PhoneNumber = $item->Value;
//            } else if ($item->Name == "TransactionDate") {
//                $TransactionDate = $item->Value;
//            }
//        }
//
//        // Check if the payment was successful (ResultCode 0 indicates success)
//        if ($ResultCode == 0) {
//            // Find the payment by CheckoutRequestID and update the status to 'completed'
//            $payment = Payment::where('payment_id', $CheckoutRequestID)->first();
//
//            if ($payment) {
//                $payment->payment_status = 'completed';
//                $payment->mpesa_receipt_number = $CheckoutRequestID;
//                $payment->transaction_date = Carbon::parse($TransactionDate)->format('Y-m-d H:i:s');
//                // Log successful payment update
//                Log::info('Payment confirmed successfully. Updated payment status for payment ID: ' . $CheckoutRequestID);
//            } else {
//                $payment->payment_status = 'failed';
//                $payment->save();
//                // Log missing payment record
//                Log::error('Payment record not found for CheckoutRequestID: ' . $CheckoutRequestID);
//            }
//        } else {
//
////            $ResultCode = $json->Body->stkCallback->ResultCode;
//
//
//
//            // Log failed payment or error response
//            Log::error('Payment failed with ResultCode: ' . $ResultCode );
//        }
//
//        // Optionally, you can send a response back to confirm receipt of the callback
////        return response()->json(['status' => 'success']);
//
//        return true;
//
//    }


//public function c2bCallback()
//{
//    $callbackJSONData = file_get_contents('php://input');
//
//    $jsonFile = fopen('c2bCallback.json', 'w');
//    fwrite($jsonFile, $callbackJSONData);
//
//    $json = json_decode($callbackJSONData);
//
//    $CheckoutRequestID = $json->Body->stkCallback->CheckoutRequestID;
//    $ResultCode = $json->Body->stkCallback->ResultCode;
//    $CallbackMetadata = $json->Body->stkCallback->CallbackMetadata;
//
//    $Amount = 0;
//    $MpesaReceiptNumber = "";
//    $PhoneNumber = "";
//    $TransactionDate = "";
//    foreach ($CallbackMetadata->Item as $item) {
//
//        if ($item->Name == "Amount") {
//            $Amount = $item->Value;
//        } else if ($item->Name == "MpesaReceiptNumber") {
//            $MpesaReceiptNumber = $item->Value;
//        } else if ($item->Name == "PhoneNumber") {
//            $PhoneNumber = $item->Value;
//        } else if ($item->Name == "TransactionDate") {
//            $TransactionDate = $item->Value;
//        }
//    }
//
//    return true;
//}


// public function stkPush(Request $request)
//    {
//        // Validate the request
//        $request->validate([
//            'first_name' => 'required|string|max:255',
//            'country' => 'required|string|max:255',
//            'county' => 'required|string|max:255',
//            'constituency' => 'required|string|max:255',
//            'street_address' => 'required|string|max:255',
//            'landmark' => 'required|string|max:255',
//            'phone' => 'required|string|max:15',
//            'email' => 'required|email|max:255',
//            'total' => 'required|numeric',
//            'shipping_method' => 'required|string',
//        ]);
//
//        if (isset($request)){
//            $BusinessShortCode = '174379';
//            $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
//            $Timestamp = date('YmdHis');
//            $TransactionType = 'CustomerBuyGoodsOnline';
//            $Amount = $request->total;
//            $PartyA = $request->phone; // Customer's phone number
//            $PartyB = $BusinessShortCode; // M-Pesa Shortcode
//            $PhoneNumber = $request->phone;
//            $CallBackURL = 'https://3a28-102-7-173-177.ngrok-free.app/mpesa/callback'; // Update with your actual callback URL
//            $AccountReference = 'Order_' . time(); // Unique order reference
//            $TransactionDesc = 'Payment for Order';
//            $Remarks = 'Payment for Order #' . $AccountReference;
//
//            $mpesa= new \Safaricom\Mpesa\Mpesa();
//
//            $stkPushSimulation=$mpesa->STKPushSimulation(
//            $BusinessShortCode,
//            $LipaNaMpesaPasskey,
//            $TransactionType,
//            $Amount,
//            $PartyA,
//            $PartyB,
//            $PhoneNumber,
//            $CallBackURL,
//            $AccountReference,
//            $TransactionDesc,
//            $Remarks);
////        dd($stkPushSimulation);
//
//                }
//        if (isset($stkPushSimulation['CheckoutRequestID']) ){
//                // Call the checkStkPushStatus method and pass the CheckoutRequestID
//                $checkoutRequestID = $stkPushSimulation['CheckoutRequestID'];
//                $status = $this->checkStkPushStatus($checkoutRequestID);
//                Log::info('STK Push Status:', $status); // Log the status for debugging
//
//            // Payment initiation was successful; save order details
//            $order = new Payment();
//            $order->first_name = $request->first_name;
//            $order->country = $request->country;
//            $order->county = $request->county;
//            $order->constituency = $request->constituency;
//            $order->street_address = $request->street_address;
//            $order->landmark = $request->landmark;
//            $order->phone = $request->phone;
//            $order->email = $request->email;
////            $order->order_notes = $request->order_notes ?? '';
//            $order->total = $request->total;
//            $order->shipping_method = $request->shipping_method;
//            $order->payment_status = 'pending'; // Set as pending until confirmation
//            $order->payment_id = $stkPushSimulation['CheckoutRequestID'] ?? null; // Save the checkout request ID
//            $order->save();
//
//            // Redirect to a success page or show a success message
//            return redirect()->back()->with('success', 'Payment initiated successfully! Please complete the payment on your phone.');
//        } else {
//            // Payment initiation failed; return an error response
//            return redirect()->back()->withErrors('Payment failed. Please try again.');
//        }
//
//    }


//    public function mpesaCallback(Request $request)
//    {
//        // Log incoming callback data
//        Log::info('M-Pesa Callback Data:', $request->all());
//
//        $callbackData = $request->all();
//
//        // Check if payment was successful
//        if (isset($callbackData['Body']['stkCallback']['ResultCode']) && $callbackData['Body']['stkCallback']['ResultCode'] == 0) {
//            // Payment was successful; update your order's status here
//            $checkoutRequestID = $callbackData['Body']['stkCallback']['CheckoutRequestID'];
//            $payment = Payment::where('payment_id', $checkoutRequestID)->first();
//
//            if ($payment) {
//                $payment->payment_status = 'completed';
//                $payment->save();
//            }
//
//            // Return success response to M-Pesa
//            $mpesa = new \Safaricom\Mpesa\Mpesa();
//            $mpesa->finishTransaction();
//        } else {
//            // Payment failed; handle failure case
//            Log::error('Payment failed:', $callbackData);
//
//            // Return failure response to M-Pesa
//            $mpesa = new \Safaricom\Mpesa\Mpesa();
//            $mpesa->finishTransaction(false);
//        }
//    }
//    public function mpesaCallback(Request $request)
//    {
//        $mpesa = new \Safaricom\Mpesa\Mpesa();
//
//        // Retrieve the callback data from M-Pesa
//        $callbackData = $mpesa->getDataFromCallback();
//
//        // Log or debug the received callback data to inspect its structure
//        Log::info('M-Pesa Callback Data: ' . json_encode($callbackData));
//        // You can also use dd($callbackData); to see the structure immediately
//
//        // Check if 'Body' and necessary keys exist in the response before accessing them
//        if (isset($callbackData['Body']['stkCallback']['ResultCode'])) {
//            $resultCode = $callbackData['Body']['stkCallback']['ResultCode'];
//            $checkoutRequestID = $callbackData['Body']['stkCallback']['CheckoutRequestID'];
//
//            if ($resultCode == 0) {
//                // Payment successful, update the payment status
//                $payment = Payment::where('payment_id', $checkoutRequestID)->first();
//                if ($payment) {
//                    $payment->payment_status = 'completed';
//                    $payment->save();
//                }
//            } else {
//                // Payment failed, update the payment status
//                $payment = Payment::where('payment_id', $checkoutRequestID)->first();
//                if ($payment) {
//                    $payment->payment_status = 'failed';
//                    $payment->save();
//                }
//            }
//        } else {
//            // Log an error or handle cases where the expected keys are missing
//            \Log::error('M-Pesa callback data missing required fields: ' . json_encode($callbackData));
//            return response()->json(['error' => 'Invalid callback data'], 400);
//        }
//
//        return response()->json(['status' => 'success'], 200);
//    }


//    public function checkStkPushStatus()
//    {
//        // Manually hardcode the CheckoutRequestID received after sending the STK Push
//        $checkoutRequestID = 'ws_CO_26092024105142166708441307'; // Replace with your actual CheckoutRequestID
//        $BusinessShortCode = '174379'; // Your M-Pesa business shortcode
//        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919'; // Your M-Pesa passkey
//
//        // Generate the current timestamp in the required format (YmdHis)
//        $Timestamp = date('YmdHis'); // This will give you the correct timestamp for querying the status
//
//        // Generate the base64-encoded password using the BusinessShortCode, Passkey, and Timestamp
//        $Password = base64_encode($BusinessShortCode . $LipaNaMpesaPasskey . $Timestamp);
//
//        // Additional security credential (if required)
//        $securityCredential = 'oEBZSggepJAiHbvwFkCkV/QUNehVTzcirZ2D7JjNBwpcby1ZKCCOREjMi0fgah5EOevzYsgk0PdJpuS7gPWNIZj0csfFctldD0NGhWzQrrttBqUanzQpcekRrTQ3pDOEgJP0DIGe8SjGesqujgvb1V0PFr2oyqCILGUV7R7efk957Pej9vpCOqOH/kxPyxqzUDG5OJKQVTKbdtacPF288pdMhQl7IBByU/jpzTWII+PdVAinNMNwUZM9zcaN0cuzvoJICzR3mr8vINfQ3lvgUvi9BXYnVwLOFIC+Vz8v5KIBUOiyNIZGMeNi48JtE88HfROPUPOzx7qTTMCwiOz/Wg=='; // Optional parameter, or you can generate it if necessary
//
//        // Initialize the Mpesa instance
//        $mpesa = new \Safaricom\Mpesa\Mpesa();
//
//        // Query the status of the STK push with 5 parameters
//        $stkPushQueryResponse = $mpesa->STKPushQuery(
//            $checkoutRequestID,      // Checkout Request ID you stored after STK Push
//            $BusinessShortCode,      // Shortcode used in STK Push
//            $Password,               // Base64 encoded password generated above
//            $Timestamp,              // Dynamically generated timestamp in YmdHis format
//            $securityCredential      // Security credential or empty string
//        );
//
//        // Decode the response from JSON
//        $response = json_decode($stkPushQueryResponse, true);
//
//        // Check the result code to determine the transaction status
//        if (isset($response['ResultCode']) && $response['ResultCode'] == 0) {
//            // Payment was successful, update the status in the database
//            $payment = Payment::where('payment_id', $checkoutRequestID)->first();
//            $payment->payment_status = 'completed';
//            $payment->save();
//
//            return response()->json(['status' => 'success', 'message' => 'Payment successful!', 'response' => $response]);
//        } else {
//            // Payment failed or is still pending
//            $payment = Payment::where('payment_id', $checkoutRequestID)->first();
//            $payment->payment_status = 'failed';
//            $payment->save();
//
//            return response()->json(['status' => 'failed', 'message' => 'Payment failed or still pending.', 'response' => $response]);
//        }
//    }
    public function checkStkPushStatus()
    {
        $checkoutRequestID = 'ws_CO_07102024132956923708441307';
        $BusinessShortCode = '174379';
        $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';

        $payment = Payment::where('payment_id', $checkoutRequestID)->first();
        $Timestamp = '20240926075124';
        $Password = base64_encode($BusinessShortCode . $LipaNaMpesaPasskey . $Timestamp);

        Log::info("Request Data", [
            'checkoutRequestID' => $checkoutRequestID,
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $Password,
            'Timestamp' => $Timestamp
        ]);

        $mpesa = new \Safaricom\Mpesa\Mpesa();

        $stkPushQueryResponse = $mpesa->STKPushQuery(
            $checkoutRequestID,
            $BusinessShortCode,
            $Password,
            $Timestamp,
            ''
        );

        Log::info("STK Push Query Response", [
            'response' => $stkPushQueryResponse
        ]);

        $response = json_decode($stkPushQueryResponse, true);

        if (isset($response['ResultCode']) && $response['ResultCode'] == 0) {
            $payment = Payment::where('payment_id', $checkoutRequestID)->first();
            $payment->payment_status = 'completed';
            $payment->save();
            return response()->json(['status' => 'success', 'message' => 'Payment successful!', 'response' => $response]);
        } else {
            $payment = Payment::where('payment_id', $checkoutRequestID)->first();
            $payment->payment_status = 'failed';
            $payment->save();
            return response()->json(['status' => 'failed', 'message' => 'Payment failed or still pending.', 'response' => $response]);
        }
    }





//    public function c2bCallback()
//    {
//        $callBackJSONData = file_get_contents('php://input');
//        $jsonFile = fopen('c2bCallback.json', 'w');
//        fwrite($jsonFile, $callBackJSONData) ;
//        return true;
//
//
//
////        dd('it worked');
//
//
//
//        $mpesa = new \Safaricom\Mpesa\Mpesa();
//
//        // Retrieve the callback data from M-Pesa
//        $callbackData = $mpesa->getDataFromCallback();
//
//        // Log the callback data to inspect its structure
//        Log::info('M-Pesa Callback Data: ' . json_encode($callbackData));
//
//        // Uncomment the line below to see the data directly in your response (for debugging)
//        // dd($callbackData); // This will dump the data and stop further execution
//
//        // Check if 'Body' and necessary keys exist in the response before accessing them
//        if (isset($callbackData['Body']['stkCallback']['ResultCode'])) {
//            $resultCode = $callbackData['Body']['stkCallback']['ResultCode'];
//            $checkoutRequestID = $callbackData['Body']['stkCallback']['CheckoutRequestID'];
//
//            if ($resultCode == 0) {
//                // Payment successful, update the payment status
//                $payment = Payment::where('payment_id', $checkoutRequestID)->first();
//                if ($payment) {
//                    $payment->payment_status = 'completed';
//                    $payment->save();
//                }
//            } else {
//                // Payment failed, update the payment status
//                $payment = Payment::where('payment_id', $checkoutRequestID)->first();
//                if ($payment) {
//                    $payment->payment_status = 'failed';
//                    $payment->save();
//                }
//            }
//        } else {
//            // Log the callback data if the expected fields are missing
//            Log::error('M-Pesa callback data missing required fields: ' . json_encode($callbackData));
//
//            // Return an error response to the client for debugging purposes
//            return response()->json(['error' => 'Invalid callback data', 'data' => $callbackData], 400);
//        }
//
//        return response()->json(['status' => 'success'], 200);
//    }
//    public function c2bCallback()
//    {
//        $callBackJSONData = file_get_contents('php://input');
//        $jsonFile = fopen('c2bcallback.json', 'w');
//        fwrite($jsonFile, $callBackJSONData);
//        return true;
////        $callbackData = json_decode($callBackJSONData, true);
//
//        // Extract necessary data
//        $checkoutRequestID = $callbackData['Body']['stkCallback']['CheckoutRequestID'];
//        $resultCode = $callbackData['Body']['stkCallback']['ResultCode'];
//        $resultDesc = $callbackData['Body']['stkCallback']['ResultDesc'];
//
//        // Check if the transaction was successful
//        if ($resultCode == 0) {
//            $mpesaReceiptNumber = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
//            $transactionDate = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][3]['Value'];
//            $phoneNumber = $callbackData['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];
//
//            // Find the corresponding payment
//            $payment = Payment::where('payment_id', $checkoutRequestID)->first();
//
//            if ($payment) {
//                // Update the payment status and additional details
//                $payment->update([
//                    'payment_status' => 'completed',
//                    'mpesa_receipt_number' => $mpesaReceiptNumber,
//                    'payment_date' => Carbon::createFromFormat('YmdHis', $transactionDate),
//                ]);
//            }
//        } else {
//            // Handle failed transactions
//            $payment = Payment::where('payment_id', $checkoutRequestID)->first();
//            if ($payment) {
//                $payment->update([
//                    'payment_status' => 'failed',
//                    'failure_reason' => $resultDesc,
//                ]);
//            }
//        }
//
//        // Log the callback data for debugging
//        file_put_contents(storage_path('logs/c2bCallback.log'), json_encode($callbackData));
//
//        return response()->json(['status' => 'ok'], 200);
//    }


//    public function checkStkPushStatus($checkoutRequestID)
//    {
//        $mpesa = new \Safaricom\Mpesa\Mpesa();
//
//        $businessShortCode = '174379'; // Replace with your short code
//        $lipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919'; // Replace with your passkey
//        $timestamp = date('YmdHis');
//        $password = base64_encode($businessShortCode . $lipaNaMpesaPasskey . $timestamp);
//
//        $stkPushRequestStatus = $mpesa->STKPushQuery($checkoutRequestID, $businessShortCode, $password, $timestamp);
//
//        Log::info('STK Push Status:', $stkPushRequestStatus);
//
//        // Update the payment status in the database based on the response
//        $payment = Payment::where('payment_id', $checkoutRequestID)->first();
//
//        if ($payment) {
//            $resultCode = $stkPushRequestStatus['ResultCode'] ?? null;
//
//            if ($resultCode === '0') {
//                $payment->payment_status = 'completed';
//            } else {
//                $payment->payment_status = 'failed';
//            }
//
//            $payment->save();
//        }
//
//        return $stkPushRequestStatus;
//    }
//
//

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
