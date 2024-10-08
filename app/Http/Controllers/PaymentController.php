<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Safaricom\Mpesa\Mpesa;
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $Timestamp = date('Y-m-d H:i:s');
        $TransactionType = 'CustomerBuyGoodsOnline';
        $Amount = $request->total;
        $PartyA = $request->phone; // Customer's phone number
        $PartyB = $BusinessShortCode; // M-Pesa Shortcode
        $PhoneNumber = $request->phone;
        $CallBackURL = 'https://8e5e-102-5-152-68.ngrok-free.app/mpesa/callback'; // Replace with your actual callback route
        $AccountReference = 'Order_' . time(); // Unique order reference
        $TransactionDesc = 'Payment for Order';
        $Remarks = 'Payment for Order #' . $AccountReference;

        $mpesa = new \Safaricom\Mpesa\Mpesa();

        $stkPushSimulation = $mpesa->STKPushSimulation(
            $BusinessShortCode,
            $LipaNaMpesaPasskey,
            $Timestamp,
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
        dd($stkPushSimulation);

        $stkPushSimulation = json_decode($stkPushSimulation, true); // Decodes to an associative array

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


    public function stk()
    {
        //
        $mpesa= new \Safaricom\Mpesa\Mpesa();

           $BusinessShortCode = '174379';
           $LipaNaMpesaPasskey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
           $Timestamp = "20160216165627";
           $TransactionType = "CustomerPayBillOnline";
           $Amount = "1";
           $PartyA = "254708441307";
           $PartyB = "174379";
           $PhoneNumber = "254708441307";
           $CallBackURL = "http://192.168.43.241:8000/mpesa/callback";
           $AccountReference = "AccountReference";
           $TransactionDesc = "TransactionDesc";
           $Remarks = 'Remarks';

        $stkPushSimulation=$mpesa->STKPushSimulation(
            $BusinessShortCode,
            $LipaNaMpesaPasskey,
            $TransactionType,
            $Amount,
            $PartyA,
            $PartyB,
            $PhoneNumber,
            $CallBackURL,
            $AccountReference,
            $TransactionDesc,
            $Remarks);
        dd($stkPushSimulation);
    }

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





    public function mpesaCallback(Request $request)
    {
        $mpesa = new \Safaricom\Mpesa\Mpesa();

        // Retrieve the callback data from M-Pesa
        $callbackData = $mpesa->getDataFromCallback();

        // Log the callback data to inspect its structure
        Log::info('M-Pesa Callback Data: ' . json_encode($callbackData));

        // Uncomment the line below to see the data directly in your response (for debugging)
        // dd($callbackData); // This will dump the data and stop further execution

        // Check if 'Body' and necessary keys exist in the response before accessing them
        if (isset($callbackData['Body']['stkCallback']['ResultCode'])) {
            $resultCode = $callbackData['Body']['stkCallback']['ResultCode'];
            $checkoutRequestID = $callbackData['Body']['stkCallback']['CheckoutRequestID'];

            if ($resultCode == 0) {
                // Payment successful, update the payment status
                $payment = Payment::where('payment_id', $checkoutRequestID)->first();
                if ($payment) {
                    $payment->payment_status = 'completed';
                    $payment->save();
                }
            } else {
                // Payment failed, update the payment status
                $payment = Payment::where('payment_id', $checkoutRequestID)->first();
                if ($payment) {
                    $payment->payment_status = 'failed';
                    $payment->save();
                }
            }
        } else {
            // Log the callback data if the expected fields are missing
            Log::error('M-Pesa callback data missing required fields: ' . json_encode($callbackData));

            // Return an error response to the client for debugging purposes
            return response()->json(['error' => 'Invalid callback data', 'data' => $callbackData], 400);
        }

        return response()->json(['status' => 'success'], 200);
    }

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
