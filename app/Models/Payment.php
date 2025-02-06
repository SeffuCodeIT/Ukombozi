<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'country',
        'street_address',
        'landmark',
        'city',
        'constituency',
        'phone',
        'email',
        'order_notes',
        'total',
        'shipping_method',
        'payment_status',
        'payment_id',
        'mpesa_receipt_number',
        'payment_date',
        'failure_reason',
    ];

    public function pesapalAccessToken(){
        if(env('PESAPAL_APP_ENVIROMENT') == 'sandbox'){
            $apiUrl = "https://cybqa.pesapal.com/pesapalv3/api/Auth/RequestToken"; // Sandbox URL
            $consumerKey = env('PESAPAL_SANDBOX_CONSUMER_KEY');
            $consumerSecret = env('PESAPAL_SANDBOX_CONSUMER_SECRET');
        }elseif(env('PESAPAL_APP_ENVIROMENT') == 'live'){
            $apiUrl = "https://pay.pesapal.com/v3/api/Auth/RequestToken"; // Live URL
            $consumerKey = env('PESAPAL_LIVE_CONSUMER_KEY');
            $consumerSecret = env('PESAPAL_LIVE_CONSUMER_SECRET');
        }else{
            echo "Invalid APP_ENVIROMENT";
            exit;
        }
        $headers = [
            "Accept: application/json",
            "Content-Type: application/json"
        ];
        $data = [
            "consumer_key" => $consumerKey,
            "consumer_secret" => $consumerSecret
        ];
        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $data = json_decode($response);

        return $data->token;
    }

    public function registerPesapalIPN(){ //Callback URL
        $url = "https://b427-2c0f-fe38-2333-a760-5e79-4e8f-3e86-4a4b.ngrok-free.app/api/pesapalIPN";
        if(env('PESAPAL_APP_ENVIROMENT') == 'sandbox'){
            $ipnRegistrationUrl = "https://cybqa.pesapal.com/pesapalv3/api/URLSetup/RegisterIPN";
        }elseif(env('PESAPAL_APP_ENVIROMENT') == 'live'){
            $ipnRegistrationUrl = "https://pay.pesapal.com/v3/api/URLSetup/RegisterIPN";
        }else{
            echo "Invalid APP_ENVIROMENT";
            exit;
        }
        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer ".$this->pesapalAccessToken()
        );
        $data = array(
            "url" => $url,
            "ipn_notification_type" => "POST"
        );
        $ch = curl_init($ipnRegistrationUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $data = json_decode($response);
        $ipn_id = $data->ipn_id;
        return $data->ipn_id;
    }

    public function getRegisteredIPNs(){
        if(env('PESAPAL_APP_ENVIROMENT') == 'sandbox'){
            $getIpnListUrl = "https://cybqa.pesapal.com/pesapalv3/api/URLSetup/GetIpnList";
        }elseif(env('PESAPAL_APP_ENVIROMENT') == 'live'){
            $getIpnListUrl = "https://pay.pesapal.com/v3/api/URLSetup/GetIpnList";
        }else{
            echo "Invalid APP_ENVIROMENT";
            exit;
        }
        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer ".$this->pesapalAccessToken()
        );
        $ch = curl_init($getIpnListUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return json_decode($response);
    }

    public function submitOrderRequest($data){


        $merchantreference = rand(1, 1000000000000000000);
        $phone = $data["phone"];
        $amount = $data['total'];
        $callbackurl = "https://b427-2c0f-fe38-2333-a760-5e79-4e8f-3e86-4a4b.ngrok-free.app/success";
        $branch = "Ukombozi Library";
        $first_name = $data['first_name'];
        $middle_name = "";
        $last_name = "";
        $email_address = $data['email'];
        if(env('PESAPAL_APP_ENVIROMENT') == 'sandbox'){
            $submitOrderUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/SubmitOrderRequest";
        }elseif(env('PESAPAL_APP_ENVIROMENT') == 'live'){
            $submitOrderUrl = "https://pay.pesapal.com/v3/api/Transactions/SubmitOrderRequest";
        }else{
            echo "Invalid APP_ENVIROMENT";
            exit;
        }
        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer ".$this->pesapalAccessToken()
        );

        // Request payload
        $data = array(
            "id" => "$merchantreference",
            "currency" => "KES",
            "amount" => $amount,
            "description" => "Pay Ukombozi Press",
            "callback_url" => "$callbackurl",
            "notification_id" => $this->registerPesapalIPN(),
            "branch" => "$branch",
            "billing_address" => array(
                "email_address" => "$email_address",
                "phone_number" => "$phone",
                "country_code" => "KE",
                "first_name" => "$first_name",
                "middle_name" => "$middle_name",
                "last_name" => "$last_name",
                "line_1" => "Pesapal Limited",
                "line_2" => "",
                "city" => "",
                "state" => "",
                "postal_code" => "",
                "zip_code" => ""
            )
        );
        $ch = curl_init($submitOrderUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response;
    }

    public function getTransactionStatus(Request $request)
    {
        $OrderTrackingId = $request['OrderTrackingId'];
//        $OrderTrackingId = '4bd3d4c7-1dd3-43d0-97bf-dca2cca5aac9';
        $OrderMerchantReference = $request['OrderMerchantReference'];
//        $OrderMerchantReference = '863265701760378671';
        if(env("PESAPAL_APP_ENVIROMENT") == 'sandbox'){
            $getTransactionStatusUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/GetTransactionStatus?orderTrackingId=$OrderTrackingId";
        }elseif(env("PESAPAL_APP_ENVIROMENT") == 'live'){
            $getTransactionStatusUrl = "https://pay.pesapal.com/v3/api/Transactions/GetTransactionStatus?orderTrackingId=$OrderTrackingId";
        }else{
            echo "Invalid APP_ENVIROMENT";
            exit;
        }
        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer ".$this->pesapalAccessToken()
        );
        $ch = curl_init($getTransactionStatusUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        echo $response = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        header("Content-Type: application/json");
        $logFile = "pesapalPaymentStatus.json";
        $log = fopen($logFile, "a");
        fwrite($log, $response);
        fclose($log);
    }
    public function refundRequest(){
        if(env('PESAPAL_APP_ENVIROMENT') == 'sandbox'){
            $refundRequestUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/RefundRequest";
        }elseif(env('PESAPAL_APP_ENVIROMENT') == 'live'){
            $refundRequestUrl = "https://pay.pesapal.com/v3/api/Transactions/RefundRequest";
        }else{
            echo "Invalid APP_ENVIROMENT";
            exit;
        }
        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer ".$this->pesapalAccessToken()
        );

        // Request payload
        $data = array(
            "confirmation_code" => "SJG594C56J",
            "amount" => "1",
            "username" => "Seffu Kamau",
            "remarks" => "Please process the refund.",
        );
        $ch = curl_init($refundRequestUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response;
    }
    public function orderCancellation(){
        if(env('PESAPAL_APP_ENVIROMENT') == 'sandbox'){
            $orderCancellationUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/CancelOrder";
        }elseif(env('PESAPAL_APP_ENVIROMENT') == 'live'){
            $orderCancellationUrl = "https://pay.pesapal.com/v3/api/Transactions/CancelOrder";
        }else{
            echo "Invalid APP_ENVIROMENT";
            exit;
        }
        $headers = array(
            "Accept: application/json",
            "Content-Type: application/json",
            "Authorization: Bearer ".$this->pesapalAccessToken()
        );

        // Request payload
        $data = array(
            "order_tracking_id" => "4bd3d4c7-1dd3-43d0-97bf-dca2cca5aac9"
        );
        $ch = curl_init($orderCancellationUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $response;
    }
}
