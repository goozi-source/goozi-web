<?php   
    session_start();
    require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
    include $_SERVER['DOCUMENT_ROOT'] . '/functions/function.php';
    
    $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
    if(!$reference){
    die('No reference supplied');
    }

    // initiate the Library's Paystack Object
    $apikey = 'sk_test_a63ff5b2c8ef23d8ea4e3b6631681767d2465549';
    $paystack = new Yabacon\Paystack($apikey);
    try
    {
    // verify using the library
    $tranx = $paystack->transaction->verify([
        'reference'=>$reference, // unique to transactions
    ]);
    } catch(\Yabacon\Paystack\Exception\ApiException $e){
    print_r($e->getResponseObject());
    die($e->getMessage());
    }

    if ('success' === $tranx->data->status) {
        global $conn;
        $session = session_id();
        $status = 'paid';
        $stat = 'Awaiting Runner';
        $user = userDetails()['id'];
        $paidAt = date('Y-m-d H:i:s');
        $batch = $_SESSION['batch'];
        $update = $conn->query("UPDATE requests SET  paidAt = '$paidAt', status = '$status', batch = '$reference' WHERE batch = '$batch' ");
        $updateRequest = $conn->query("INSERT INTO requestStatus (batch, user, status) VALUES('$reference', '$user', '$stat') ");
        if($update && $updateRequest)
        {
            echo "<script>window.open('/complete-order/$reference', '_self')</script>";
        }
        elseif(!$update)
        {
            echo("Error description: " . mysqli_error($conn) . mysqli_errno($conn));
        }
    }