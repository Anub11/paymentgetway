<?php  

// $email=$_POST['email'];
// $price=$_POST['amount'];

// include ('instamojo/Instamojo.php');

// $api = new Instamojo\Instamojo('test_1d60d972f00f38e1ef363496276', 'test_5487a06fc64f87ef93f8a8b70a1', 'https://test.instamojo.com/api/1.1/');

// try {
//     $response = $api->paymentRequestCreate(array(
//         "purpose" => "Donate",
//         "amount" => $price,
//         "send_email" => true,
//         "email" => $email,
//         "send_sms"=>true,
//         "allow_repeated_payments"=>false,
//         // "webhook"=>
//         "redirect_url" => "http://localhost/paymentGetway/thankyou.php"
//         ));
//     // print_r($response);
//     $pay_url=$response['longurl'];
//     header("localhost:$pay_url");
// }
// catch (Exception $e) {
//     print('Error: ' . $e->getMessage());
// }


$email=$_POST['email'];
$price=$_POST['amount'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:XXXXXXXXXXXXXXXXXXXXXXXXXX",
                  "X-Auth-Token:XXXXXXXXXXXXXXXXXXXXXXXXXX"));
$payload = Array(
    'purpose' => 'DONATE',
    'amount' => $price,
    'redirect_url' => 'http://localhost/paymentGetway/thankyou.php',
    'send_email' => true,
    'email' => $email,
    'allow_repeated_payments' => false
);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
$response = curl_exec($ch);
curl_close($ch); 
// $pay_url=$response['longurl'];
// header("localhost:$pay_url");
$response = json_decode($response);
// echo '<pre>';
// print_r($response);

header('location:'.$response->payment_request->longurl);

?>
