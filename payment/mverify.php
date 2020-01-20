<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT']. '/functions/function.php';
    $data = array();
    $error = array();
    if(isset($_POST['ref'])):
        global $conn;
        $session = session_id();
        $reference = $_POST['ref'];
        $status = 'paid';
        $stat = 'Awaiting Runner';
        $user = userDetails()['id'];
        $paidAt = date('Y-m-d H:i:s');
        $batch = $_SESSION['batch'];
        $update = $conn->query("UPDATE requests SET  paidAt = '$paidAt', status = '$status', batch = '$reference' WHERE session = '$session' ");
        $updateRequest = $conn->query("INSERT INTO requestStatus (batch, user, status) VALUES('$reference', '$user', '$stat') ");
        if($update && $updateRequest)
        {
            $data['success'] = true;
            $data['message'] = "Payment Successful";
            echo json_encode($data);
        }
        else{
            $error['success'] = true;
            $error['message'] = $conn->error;
            echo json_encode($error);
        }
    endif;