<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$servername = 'localhost';
$username = '';
$password = '';
$dbname = '';
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: '.$conn->connect_error);
    echo 'connect_error';
}


function AppName()
{
	$app = 'GOOZI';
	return $app;
}

function secure($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
}

function getAll($db)
{
    global $conn;
    $query = $conn->query("SELECT * FROM $db");
    if($query):
        $getall = $query->fetch_all(MYSQLI_ASSOC);
        return $getall;
    endif;
}


function getWhere($table, $column, $operator, $param)
{
    global $conn;
    $query = $conn->query("SELECT * FROM $table WHERE $column $operator '$param' ");
    if($query):
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return $result;
    else:
        echo $conn->error;
    endif;
}

function getAnd($table, $col1, $op1, $p1, $col2, $op2, $p2)
{
    global $conn;
    $query = $conn->query("SELECT * FROM $table WHERE $col1 $op1 '$p1' AND $col2 $op2  '$p2' ");
    if ($query):
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return $result;
    else:
        echo $conn->error;
    endif;
}

function groupBy($table, $groupBy)
{
    global $conn;
    $query = $conn->query("SELECT * FROM $table GROUP BY $groupBy ");
    if($query):
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return $result;
    else:
        echo $conn->error;
    endif;
}
function groupWhere($table, $column, $operator, $param, $groupBy)
{
    global $conn;
    $query = $conn->query("SELECT * FROM $table WHERE $column $operator '$param' GROUP BY $groupBy ");
    if($query):
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return $result;
    else:
        echo $conn->error;
    endif;
}

function groupAnd($table, $col1, $op1, $p1, $col2, $op2, $p2, $groupBy)
{
    global $conn;
    $query = $conn->query("SELECT * FROM $table WHERE $col1 $op1 '$p1' AND $col2 $op2  '$p2' GROUP BY $groupBy ");
    if($query):
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return $result;
    else:
        echo $conn->error;
    endif;
}

function countStuff($db)
{
    global $conn;
    $query = $conn->query("SELECT COUNT(*) AS totalCount FROM $db ");
    if ($query):
        $count = $query->fetch_assoc();
        return $count['totalCount']; 
    else:
        echo $conn->error;
    endif;
}

function countWhere($table, $column, $operator, $parameter)
{
    global $conn;
    $query = $conn->query("SELECT COUNT(*) AS totalCount FROM $table WHERE $column $operator '$parameter' ");
    if ($query):
        $count = $query->fetch_assoc();
        return $count['totalCount']; 
    else:
        echo $conn->error;
    endif;
}

function countAnd($table, $col1, $op1, $p1, $col2, $op2, $p2)
{
    global $conn;
    $query = $conn->query("SELECT COUNT(*) AS totalCount FROM $table WHERE $col1 $op1 '$p1' AND $col2 $op2  '$p2' ");
    if ($query):
        $count = $query->fetch_assoc();
        return $count['totalCount']; 
    else:
        echo $conn->error;
    endif;
}

function countDistinct($table, $column, $operator, $parameter, $dist)
{
    global $conn;
    $query = $conn->query("SELECT COUNT(DISTINCT $dist) AS totalCount FROM $table WHERE $column $operator '$parameter' ");
    if ($query):
        $count = $query->fetch_assoc();
        return $count['totalCount']; 
    else:
        echo $conn->error;
    endif;
}

function getTotal($table, $sum_column, $column, $operator, $parameter)
{
    global $conn;
    $query = $conn->query("SELECT SUM($sum_column) AS totalSum FROM $table WHERE $column $operator '$parameter' ");
    if ($query):
        $sum = $query->fetch_assoc();
        if ($sum['totalSum'] > 0):
            return $sum['totalSum'];
        else:
            return '0';
        endif;
    else:
        echo $conn->error;
    endif;
}

function getSumAnd($table, $sum_column, $col1, $op1, $p1, $col2, $op2, $p2)
{
    global $conn;
    $query = $conn->query("SELECT SUM($sum_column) AS totalSum FROM $table WHERE $col1 $op1 '$p1' AND $col2 $op2  '$p2' ");
    if ($query):
        $sum = $query->fetch_assoc();
        if ($sum['totalSum'] > 0):
            return $sum['totalSum'];
        else:
            return '0';
        endif;
    else:
        echo $conn->error;
    endif;
}

function authenticateUser()
{
	global $conn;
	if(!isset($_SESSION['email'])):
		$_SESSION['login_error'] = "<p class='text-danger text-center'>You need to login to proceed</p>";
		$sess  = $_SESSION['login_error'];
		echo "<script>alert('$sess')</script>";
		echo "<script>window.open('/index', '_self')</script>";
	else:
		$email = $_SESSION['email'];
		$checkUser = $conn->query("SELECT * FROM users WHERE email = '$email' ");
		$checkRunner = $conn->query("SELECT * FROM runners WHERE email = '$email' ");
		if($checkRunner->num_rows > 0):
			$_SESSION['user_type'] = 'runner';
		elseif($checkUser->num_rows > 0):
			$users = $checkUser->fetch_assoc();
			$userType = $users['type'];
			if($userType == 2):
				$_SESSION['user_type'] = 'user';
			elseif($userType == 1):
				$_SESSION['user_type'] = 'admin';
			endif;
		endif;
	endif;
}


function userDetails()
{
	global $conn;
	if(isset($_SESSION['email'])):
	    $email = $_SESSION['email'];
    	$userType = $_SESSION['user_type'];
    	if($userType == 'runner'):
    		$query = $conn->query("SELECT * FROM runners WHERE email = '$email' ");
    		if($query->num_rows > 0):
    			$getUser = $query->fetch_assoc();
    			return $getUser;
    		else:
    			$_SESSION['userDetails'] = "<p class='text-danger text-center'>Unathorized Access</p>";
    			echo "<script>window.open('/index', '_self')</script>";
    		endif;
    	elseif($userType == 'user' || $userType == 'admin'):
    		$query = $conn->query("SELECT * FROM users WHERE email = '$email' ");
    		if($query->num_rows > 0):
    			$getUser = $query->fetch_assoc();
    			return $getUser;
    		else:
    			$_SESSION['userDetails'] = "<p class='text-danger text-center'>Unathorized Access</p>";
    			echo "<script>window.open('/index', '_self')</script>";
    		endif;
    	endif;
	endif;
}

function runnerSignup()
{
    if(isset($_POST['runnerSignup'])):
    	global $conn;
    	$fname = secure($_POST['fname']);
    	$mname = secure($_POST['mname']);
    	$lname = secure($_POST['lname']);
    	$dob = secure($_POST['dob']);
    	$bvn = secure($_POST['bvn']);
    	$gender = secure($_POST['gender']);
    	$mstatus = secure($_POST['mstatus']);
    	$kids = secure($_POST['kids']);
    	$religion = secure($_POST['religion']);
    	$address = secure($_POST['address']);
        $email = secure($_POST['email']);
        $phone = secure($_POST['phone']);
    	if(isset($_FILES['police']) && isset($_FILES['picture']) && $_FILES["police"]["error"] == 0 && $_FILES["picture"]["error"] == 0):
    		$police = $_FILES['police']['name'];
            $police_tmp = $_FILES['police']['tmp_name'];
            $temp = explode(".", $_FILES["police"]["name"]);
            $newPolice = mt_rand() . '.' . end($temp);
			$savePolice = './police_reports/';

			$picture = $_FILES['picture']['name'];
            $picture_tmp = $_FILES['picture']['tmp_name'];
            $pictemp = explode(".", $_FILES["picture"]["name"]);
            $newPicture = mt_rand() . '.' . end($pictemp);
			$savePicture = './passports/';
			if($_FILES["police"]["error"] > 0):
				echo "<p class='text-danger text-center'>Error uploading police report</p>";
			elseif($_FILES["picture"]["error"] > 0):
				echo "<p class='text-danger text-center'>Error uploading police report</p>";
			else:
                if (move_uploaded_file($police_tmp, $savePolice.$newPolice) && move_uploaded_file($picture_tmp, $savePicture.$newPicture)):
                    $verifyEmail = $conn->query("SELECT * FROM runners WHERE email = '$email' ");
                    $verifyPhone = $conn->query("SELECT * FROM runners WHERE phone = '$phone' ");
                    if($verifyEmail->num_rows > 0):
                        echo "<p class='text-danger text-center'>Email has already been used by another runner</p>";
                        return false;
                    endif;
                    if($verifyPhone->num_rows > 0):
                        echo "<p class='text-danger text-center'>Phone number has already been used by another runner</p>";
                        return false;
                    endif;
                    $query = $conn->query("INSERT INTO runners (fname, mname, lname, dob, bvn, gender, mstatus, kids, religion, address, email, phone, police, picture) VALUES ('$fname', '$mname', '$lname', '$dob', '$bvn', '$gender', '$mstatus', '$kids', '$religion', '$address', '$email', '$phone', '$newPolice', '$newPicture') ");
                    if($query):
                        echo "
                            <p class='text-success'>Registration Successful</p>
                            <script>window.open('/runner-thanks', '_self')</script>
                        ";
                    else:
                        echo "<p class='text-danger text-center'>". $conn->errno . " " . $conn->error."</p>";
                    endif;
				else:
					echo "<p class='text-danger text-center'>Error uploading files</p>";
				endif;
            endif;
        else:
            echo "<p class='text-danger text-center'>No files uploaded</p>";
            echo $_FILES['picture']['error'];
            echo $_FILES['police']['error'];
    	endif;
    endif;
}

function runnerLogin()
{
	global $conn;
	if(isset($_POST['runnerLogin'])):
		$email = secure($_POST['email']);
		$password = secure($_POST['password']);
        $origin = $_SERVER["HTTP_REFERER"];
		$query = $conn->query("SELECT * FROM runners WHERE email = '$email' ");
		if($query->num_rows > 0):
			$checkPass = $query->fetch_assoc();
			$pass = $checkPass['pin'];
            $type = $checkPass['type'];
			$verifyPass = password_verify($password, $pass);
			if($verifyPass == TRUE):
				$_SESSION['email'] = $email;
                $_SESSION['runnerLogin'] = "<p class='text-success'>Login Successful</p>";
                echo "<script>window.open('/runner/home', '_self')</script>";
			else:
				$_SESSION['userLogin'] = "<p class='text-danger'>Password is incorrect</p>";
				echo "<script>window.open('$origin', '_self')</script>";
			endif;
		else:
			$_SESSION['userLogin'] = "<p class='text-danger'>Email is not associated to any account</p>";
			echo "<script>window.open('$origin', '_self')</script>";
		endif;
	endif;
}

function userSignup()
{
	global $conn;
	if (isset($_POST['userSignup'])):
		$fname = secure($_POST['fname']);
    	$lname = secure($_POST['lname']);
    	$address = secure($_POST['address']);
        $email = secure($_POST['email']);
        $phone = secure($_POST['phone']);
        $password = secure($_POST['password']);
        $cpassword = secure($_POST['cpassword']);
        $verifyEmail = $conn->query("SELECT * FROM users WHERE email = '$email' ");
        $verifyPhone = $conn->query("SELECT * FROM users WHERE phone = '$phone' ");
        if($verifyEmail->num_rows > 0):
            $_SESSION['userReg_error'] =  "<p class='text-danger text-center'>Email has already been used by another user</p>";
            return false;
        endif;
        if($verifyPhone->num_rows > 0):
            $_SESSION['userReg_error'] = "<p class='text-danger text-center'>Phone number has already been used by another user</p>";
            return false;
        endif;

        if($password != $cpassword):
        	$_SESSION['userReg_error'] = "<p class='text-danger text-center'>Passwords do not match</p>";
            return false;
        else:
        	$pass = password_hash($password, PASSWORD_DEFAULT);
        endif;

        $query = $conn->query("INSERT INTO users (fname, lname, address, email, phone, password) VALUES ('$fname', '$lname', '$address', '$email', '$phone', '$pass')");
        if($query):
        	$_SESSION['userReg_success'] = "<p class='text-success'>Registration Successful</p>";
        	$_SESSION['email'] = $email;
        	echo "<script>window.open('/user/thanks', '_self')</script>";
        else:
        	$_SESSION['userReg_error'] = "<p class='text-danger text-center'>". $conn->errno . " " . $conn->error."</p>";
        endif;
	endif;
}

function userLogin()
{
	global $conn;
	if(isset($_POST['userLogin'])):
		$email = secure($_POST['email']);
		$password = secure($_POST['password']);
        $origin = $_SERVER["HTTP_REFERER"];
		$query = $conn->query("SELECT * FROM users WHERE email = '$email' ");
		
		if($query->num_rows > 0):
			$checkPass = $query->fetch_assoc();
			$pass = $checkPass['password'];
            $type = $checkPass['type'];
			$verifyPass = password_verify($password, $pass);
			if($verifyPass == TRUE):
				
				$_SESSION['userLogin'] = "<p class='text-success'>Login Successful</p>";
                if($type == 2):
                    
                    $_SESSION['email'] = $email;
                    $sess = $_SESSION['email'];
                    
                    echo "<script>window.open('/user/home', '_self')</script>";
                elseif($type == 1):
                    $_SESSION['email'] = $email;
                    echo "<script>window.open('/admin/home', '_self')</script>";
                endif;
				
			else:
				$_SESSION['userLogin'] = "<p class='text-danger'>Password is incorrect</p>";
				echo "<script>window.open('$origin', '_self')</script>";
			endif;
		else:
			$_SESSION['userLogin'] = "<p class='text-danger'>Email is not associated to any account</p>";
			echo "<script>window.open('$origin', '_self')</script>";
		endif;
	endif;
}

function userUpdate()
{
	global $conn;
	if (isset($_POST['userUpdate'])):
		$fname = secure($_POST['fname']);
    	$lname = secure($_POST['lname']);
    	$address = secure($_POST['address']);
        $email = secure($_POST['email']);
        $phone = secure($_POST['phone']);
        $verifyEmail = $conn->query("SELECT * FROM users WHERE email = '$email' ");
        $verifyPhone = $conn->query("SELECT * FROM users WHERE phone = '$phone' ");
        if($verifyEmail->num_rows > 0):
            $_SESSION['userUpdate_error'] =  "<p class='text-danger text-center'>Email has already been used by another user</p>";
            return false;
        endif;
        if($verifyPhone->num_rows > 0):
            $_SESSION['userUpdate_error'] = "<p class='text-danger text-center'>Phone number has already been used by another user</p>";
            return false;
        endif;

        $query = $conn->query("UPDATE users fname = '$fname', lname =  '$lname', address = '$address', email = '$email', phone = '$phone' ");
        if($query):
        	$_SESSION['userUpdate_success'] = "<p class='text-success'>Profile Update Successfully</p>";
        	$_SESSION['email'] = $email;
        	echo "<script>window.open('/user/home', '_self')</script>";
        else:
        	$_SESSION['userUpdate_error'] = "<p class='text-danger text-center'>". $conn->errno . " " . $conn->error."</p>";
        endif;
	endif;
}



function inviteApplicant($status)
{
    global $conn;
    if (isset($_POST['inviteApplicant'])):
        $runner = secure($_POST['runner']);
        $fname = secure($_POST['fname']);
        $mail = secure($_POST['email']);
        $query = $conn->query("UPDATE runners SET status = '$status' WHERE id = '$runner' ");
        if($query):
            $message = "we are pleased to inform you that your application to be a runner on the GOOZI app has been reviewed and we would contact you for an interview shortly.";
            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("test@test.com", "GOOZI TEST");
            $email->setSubject("GOOZI APPLICATION");
            $email->addTo("$mail", "$fname");
            $email->addContent(
                "text/html", '<!DOCTYPE html><html style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><meta name="viewport" content="width=device-width"/><title>Actionable emails e.g. reset password</title><style type="text/css">img{max-width: 100%;}body{-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;}body{background-color: #f6f6f6;}@media only screen and (max-width: 640px){body{padding: 0 !important;}h1{font-weight: 800 !important; margin: 20px 0 5px !important;}h2{font-weight: 800 !important; margin: 20px 0 5px !important;}h3{font-weight: 800 !important; margin: 20px 0 5px !important;}h4{font-weight: 800 !important; margin: 20px 0 5px !important;}h1{font-size: 22px !important;}h2{font-size: 18px !important;}h3{font-size: 16px !important;}.container{padding: 0 !important; width: 100% !important;}.content{padding: 0 !important;}.content-wrap{padding: 10px !important;}.invoice{width: 100% !important;}}</style></head><body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><table class="body-wrap" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td><td class="container" width="600" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top"> <div class="content" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;"> <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top"> <meta itemprop="name" content="Confirm Email" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"/><table width="100%" cellpadding="0" cellspacing="0" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top"> Hello '. $fname .', '.$message .'</td></tr></table></td></tr></table><div class="footer" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;"> <table width="100%" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="aligncenter content-block" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">Follow <a href="http://twitter.com/mail_gun" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">GOOZI</a></td></tr></table></div></div></td><td style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td></tr></table></body></html>'
            );
            $apiKey = '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';
            $sendgrid = new \SendGrid($apiKey);
            try {
                $response = $sendgrid->send($email);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        endif;
    endif;
}

function approveApplication($status)
{
    if (isset($_POST['approveApplication'])):
        global $conn;
        $runner = secure($_POST['runner']);
        $fname = secure($_POST['fname']);
        $mail = secure($_POST['email']);
        $pass = mt_rand();
        $pin = password_hash($pass, PASSWORD_DEFAULT);
        $query = $conn->query("UPDATE runners SET status = '$status', pin = '$pin' WHERE id = '$runner' ");
        if($query):
            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("test@test.com", "GOOZI TEST");
            $email->setSubject("GOOZI APPLICATION");
            $email->addTo("$mail", "$fname");
            $email->addContent(
                "text/html", '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"xmlns:v="urn:schemas-microsoft-com:vml"xmlns:o="urn:schemas-microsoft-com:office:office"><head><!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--><title>meowgun</title><meta http-equiv="X-UA-Compatible" content="IE=edge"/><meta name="viewport" content="width=device-width, initial-scale=1.0 "/><meta name="format-detection" content="telephone=no"/><link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,700,700i,900,900i" rel="stylesheet"/><style type="text/css">body{margin: 0; padding: 0; -webkit-text-size-adjust: 100% !important; -ms-text-size-adjust: 100% !important; -webkit-font-smoothing: antialiased !important;}img{border: 0 !important; outline: none !important;}p{Margin: 0px !important; Padding: 0px !important;}table{border-collapse: collapse; mso-table-lspace: 0px; mso-table-rspace: 0px;}td, a, span{border-collapse: collapse; mso-line-height-rule: exactly;}.ExternalClass *{line-height: 100%;}.em_blue a{text-decoration:none; color:#264780;}.em_grey a{text-decoration:none; color:#434343;}.em_white a{text-decoration:none; color:#ffffff;}@media only screen and (min-width:481px) and (max-width:649px){.em_main_table{width: 100% !important;}.em_wrapper{width: 100% !important;}.em_hide{display:none !important;}.em_aside10{padding:0px 10px !important;}.em_h20{height:20px !important; font-size: 1px!important; line-height: 1px!important;}.em_h10{height:10px !important; font-size: 1px!important; line-height: 1px!important;}.em_aside5{padding:0px 10px !important;}.em_ptop2{padding-top:8px !important;}}@media only screen and (min-width:375px) and (max-width:480px){.em_main_table{width: 100% !important;}.em_wrapper{width: 100% !important;}.em_hide{display:none !important;}.em_aside10{padding:0px 10px !important;}.em_aside5{padding:0px 8px !important;}.em_h20{height:20px !important; font-size: 1px!important; line-height: 1px!important;}.em_h10{height:10px !important; font-size: 1px!important; line-height: 1px!important;}.em_font_11{font-size: 12px !important;}.em_font_22{font-size: 22px !important; line-height:25px !important;}.em_w5{width:7px !important;}.em_w150{width:150px !important; height:auto !important;}.em_ptop2{padding-top:8px !important;}u + .em_body .em_full_wrap{width:100% !important; width:100vw !important;}}@media only screen and (max-width:374px){.em_main_table{width: 100% !important;}.em_wrapper{width: 100% !important;}.em_hide{display:none !important;}.em_aside10{padding:0px 10px !important;}.em_aside5{padding:0px 8px !important;}.em_h20{height:20px !important; font-size: 1px!important; line-height: 1px!important;}.em_h10{height:10px !important; font-size: 1px!important; line-height: 1px!important;}.em_font_11{font-size: 11px !important;}.em_font_22{font-size: 22px !important; line-height:25px !important;}.em_w5{width:5px !important;}.em_w150{width:150px !important; height:auto !important;}.em_ptop2{padding-top:8px !important;}u + .em_body .em_full_wrap{width:100% !important; width:100vw !important;}}</style></head><body class="em_body" style="margin:0px auto; padding:0px;" bgcolor="#efefef"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="em_full_wrap" align="center" bgcolor="#efefef"> <tr> <td align="center" valign="top"><table align="center" width="650" border="0" cellspacing="0" cellpadding="0" class="em_main_table" style="width:650px; table-layout:fixed;"> <tr> <td align="center" valign="top" style="padding:0 25px;" class="em_aside10"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"> <tr> <td height="25" style="height:25px;" class="em_h20">&nbsp;</td></tr><tr> <td align="center" valign="top"><a href="#" target="_blank" style="text-decoration:none;"><h1>GOOZI</h1></a></td></tr><tr> <td height="28" style="height:28px;" class="em_h20">&nbsp;</td></tr></table> </td></tr></table> </td></tr></table><table width="100%" border="0" cellspacing="0" cellpadding="0" class="em_full_wrap" align="center" bgcolor="#efefef"> <tr> <td align="center" valign="top" class="em_aside5"><table align="center" width="650" border="0" cellspacing="0" cellpadding="0" class="em_main_table" style="width:650px; table-layout:fixed;"> <tr> <td align="center" valign="top" style="padding:0 25px; background-color:#ffffff;" class="em_aside10"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"> <tr> <td height="45" style="height:45px;" class="em_h20">&nbsp;</td></tr><tr> <td class="em_blue em_font_22" align="center" valign="top" style="font-family: Arial, sans-serif; font-size: 26px; line-height: 29px; color:#264780; font-weight:bold;">Congratulations!!!</td></tr><tr> <td height="14" style="height:14px; font-size:0px; line-height:0px;">&nbsp;</td></tr><tr> <td class="em_grey" align="center" valign="top" style="font-family: Arial, sans-serif; font-size: 16px; line-height: 26px; color:#434343;"><b>'.$fname .'</b>, Your application to be a runner on the GOOZI app has been approved after your interview perfomance, you\'re now a runner on goozi. <br>Your pin is written below be careful not to loose it.</td></tr><tr> <td height="26" style="height:26px;" class="em_h20">&nbsp;</td></tr><tr> <td align="center" valign="top"><table width="250" style="width:250px; background-color:#6bafb2; border-radius:4px;" border="0" cellspacing="0" cellpadding="0" align="center"> <tr> <td class="em_white" height="42" align="center" valign="middle" style="font-family: Arial, sans-serif; font-size: 16px; color:#ffffff; font-weight:bold; height:42px;"><a href="#" style="text-decoration:none; color:#ffffff; line-height:42px; display:block;">'.$pass.'</a></td></tr></table> </td></tr><tr> <td height="25" style="height:25px;" class="em_h20">&nbsp;</td></tr><tr> <td height="44" style="height:44px;" class="em_h20">&nbsp;</td></tr></table> </td></tr></table> </td></tr></table><table width="100%" border="0" cellspacing="0" cellpadding="0" class="em_full_wrap" align="center" bgcolor="#efefef"> <tr> <td align="center" valign="top"><table align="center" width="650" border="0" cellspacing="0" cellpadding="0" class="em_main_table" style="width:650px; table-layout:fixed;"> <tr> <td align="center" valign="top" style="padding:0 25px;" class="em_aside10"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"> <tr> <td height="40" style="height:40px;" class="em_h20">&nbsp;</td></tr><tr> <td align="center" valign="top"><table border="0" cellspacing="0" cellpadding="0" align="center"> <tr> <td width="30" style="width:30px;" align="center" valign="middle"><a href="#" target="_blank" style="text-decoration:none;"><h1>GOOZI</h1></a></td><td width="12" style="width:12px;">&nbsp;</td></tr></table> </td></tr><tr> <td height="16" style="height:16px; font-size:1px; line-height:1px; height:16px;">&nbsp;</td></tr><tr> <td class="em_grey" align="center" valign="top" style="font-family: Arial, sans-serif; font-size: 15px; line-height: 18px; color:#434343; font-weight:bold;">Problems or questions?</td></tr><tr> <td height="10" style="height:10px; font-size:1px; line-height:1px;">&nbsp;</td></tr></table> </td></tr><tr> <td height="9" style="font-size:0px; line-height:0px; height:9px;" class="em_h10"><img src="/assets/pilot/images/templates/spacer.gif" width="1" height="1" alt="" border="0" style="display:block;"/></td></tr><tr> <td align="center" valign="top"><table border="0" cellspacing="0" cellpadding="0" align="center"> <tr> <td width="12" align="left" valign="middle" style="font-size:0px; line-height:0px; width:12px;"><a href="#" target="_blank" style="text-decoration:none;"><img src="/assets/pilot/images/templates/img_1.png" width="12" height="16" alt="" border="0" style="display:block; max-width:12px;"/></a></td><td width="7" style="width:7px; font-size:0px; line-height:0px;" class="em_w5">&nbsp;</td></tr></table> </td></tr><tr> <td height="35" style="height:35px;" class="em_h20">&nbsp;</td></tr></table> </td></tr><tr> <td height="1" bgcolor="#dadada" style="font-size:0px; line-height:0px; height:1px;"><img src="/assets/pilot/images/templates/spacer.gif" width="1" height="1" alt="" border="0" style="display:block;"/></td></tr><tr> <td align="center" valign="top" style="padding:0 25px;" class="em_aside10"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center"> <tr> <td height="16" style="font-size:0px; line-height:0px; height:16px;">&nbsp;</td></tr><tr> <td height="16" style="font-size:0px; line-height:0px; height:16px;">&nbsp;</td></tr></table> </td></tr><tr> <td class="em_hide" style="line-height:1px;min-width:650px;background-color:#efefef;"><img alt="" src="/assets/pilot/images/templates/spacer.gif" height="1" width="650" style="max-height:1px; min-height:1px; display:block; width:650px; min-width:650px;" border="0"/></td></tr></table> </td></tr></table></body></html>'
            );
            $apiKey = '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';
            $sendgrid = new \SendGrid($apiKey);
            try {
                $response = $sendgrid->send($email);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        endif;
    endif;
}

function declineApplication()
{
    if (isset($_POST['declineApplication'])):
        global $conn;
        $runner = secure($_POST['runner']);
        $fname = secure($_POST['fname']);
        $mail = secure($_POST['email']);
        $query = $conn->query("UPDATE runners SET status = '$status' WHERE id = '$runner' ");
        if($query):
            $message= "We are sad to inform you that your application to be a runner on the GOOZI app has been reviewed and you do not meet the criteria to be a runner on GOOZI.";
            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("test@test.com", "GOOZI TEST");
            $email->setSubject("GOOZI APPLICATION");
            $email->addTo("$mail", "$fname");
            $email->addContent(
                "text/html", '<!DOCTYPE html><html style="font-family: \'Helvetica Neue\', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><head><meta name="viewport" content="width=device-width"/><title>Actionable emails e.g. reset password</title><style type="text/css">img{max-width: 100%;}body{-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;}body{background-color: #f6f6f6;}@media only screen and (max-width: 640px){body{padding: 0 !important;}h1{font-weight: 800 !important; margin: 20px 0 5px !important;}h2{font-weight: 800 !important; margin: 20px 0 5px !important;}h3{font-weight: 800 !important; margin: 20px 0 5px !important;}h4{font-weight: 800 !important; margin: 20px 0 5px !important;}h1{font-size: 22px !important;}h2{font-size: 18px !important;}h3{font-size: 16px !important;}.container{padding: 0 !important; width: 100% !important;}.content{padding: 0 !important;}.content-wrap{padding: 10px !important;}.invoice{width: 100% !important;}}</style></head><body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><table class="body-wrap" style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6"><tr style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td style="font-family: \'Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td><td class="container" width="600" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top"> <div class="content" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;"> <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action" itemscope itemtype="http://schema.org/ConfirmAction" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff"><tr style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-wrap" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;" valign="top"> <meta itemprop="name" content="Confirm Email" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"/><table width="100%" cellpadding="0" cellspacing="0" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="content-block" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;" valign="top"> Hello '. $fname .', '.$message .'</td></tr></table></td></tr></table><div class="footer" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;"> <table width="100%" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><tr style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;"><td class="aligncenter content-block" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;" align="center" valign="top">Follow <a href="http://twitter.com/mail_gun" style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;">GOOZI</a></td></tr></table></div></div></td><td style="\Helvetica Neue\',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td></tr></table></body></html>'
            );
            $apiKey = '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';
            $sendgrid = new \SendGrid($apiKey);
            try {
                $response = $sendgrid->send($email);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        endif;
    endif;
}

function createMarket()
{
    if(isset($_POST['createMarket'])):
        global $conn;
        $market = secure($_POST['market']);
        $lga = secure($_POST['lga']);
        $query = $conn->query("INSERT INTO markets (market, lga) VALUES ('$market', '$lga') ");
        if($query):
            $origin = $_SERVER['HTTP_REFERER'];
            echo "
                <script>
                    alert('$market Market Created')
                    window.open('/admin/home', '_self')
                </script>
            ";
        else:
            echo $conn->error;
        endif;
    endif;
}

function createVendors()
{
    if (isset($_POST['createVendor'])):
        global $conn;
        $name = secure($_POST['name']);
        $market = secure($_POST['market']);
        $phone = secure($_POST['phone']);
        $address = secure($_POST['address']);
        $query = $conn->query("INSERT INTO vendors (name, market, phone, address) VALUES ('$name', '$market', '$phone', '$address') ");
        if($query):
            $origin = $_SERVER['HTTP_REFERER'];
            echo "
                <script>
                    alert('Vendor Created')
                    window.open('$origin', '_self')
                </script>
            ";
        else:
            echo $conn->error;
        endif;
    endif;
}

function addItems()
{
    if (isset($_POST['addItems'])):
        global $conn;
        $name = secure($_POST['name']);
        $price = secure($_POST['price']);
        $vendor = secure($_POST['vendor']);
        $getmarket = getWhere('vendors', 'id', '=', $vendor);
        $markets = array_shift($getmarket);
        $market = $markets['market'];
        if(isset($_FILES['picture'])):
            $picture = $_FILES['picture']['name'];
            $picture_tmp = $_FILES['picture']['tmp_name'];
            $pictemp = explode(".", $_FILES["picture"]["name"]);
            $newPicture = mt_rand() . '.' . end($pictemp);
            $savePicture = '../items/';
            if($_FILES["picture"]["error"] > 0):
                echo "<p class='text-danger text-center'>Error uploading police report</p>";
            elseif(move_uploaded_file($picture_tmp, $savePicture.$newPicture)):
                $query = $conn->query("INSERT INTO items (name, price, market, vendor, picture) VALUES ('$name', '$price', '$market', '$vendor', '$newPicture') ");
                if($query):
                    $origin = $_SERVER['HTTP_REFERER'];
                    echo "
                        <script>
                            alert('Item added')
                            window.open('$origin', '_self')
                        </script>
                    ";
                else:
                    echo $conn->error;
                endif;
            endif;
        endif; 
    endif;
}



function setStatus()
{
    global $conn;
    if(isset($_POST['setStatus'])):
        $status = secure($_POST['status']);
        $origin = $_SERVER['HTTP_REFERER'];
       if (!empty($_POST['id'])) {
           $runner = secure($_POST['id']);
       }
        if($status == 'available'):
            $lga = secure($_POST['lga']);
            $query = $conn->query("UPDATE runners SET availability = '$status', currentLGA = '$lga' WHERE id = '$runner' ");
            if($query):
                echo "
                    <script>
                        alert('You\'re now available')
                        window.open('$origin', '_self');
                    </script>
                ";
            else:
                echo $conn->error;
            endif;
        elseif($status == 'unavailable'):
            $query = $conn->query("UPDATE runners SET availability = '$status' WHERE id = '$runner' ");
            if($query):
                echo "
                    <script>
                        alert('You\'re now unavailable')
                        window.open('$origin', '_self');
                    </script>
                ";
            else:
                echo $conn->error;
            endif;
        elseif($status == 'active'):
            $batch = secure($_POST['batch']);
            $stat = secure($_POST['stat']);
            $query = $conn->query("UPDATE runners SET availability = '$status' WHERE id = '$runner' ");
            $updateStat = $conn->query("UPDATE requests SET runner = '$runner' WHERE batch = '$batch' ");
            $updateStats = $conn->query("UPDATE requestStatus SET runner = '$runner', status = '$stat' WHERE batch = '$batch' ");
            if($query && $updateStat && $updateStats):
                echo "
                    <script>
                        alert('You\'ve been assigned to errand #$batch')
                        window.open('$origin', '_self');
                    </script>
                ";
            else:
                echo $conn->error;
            endif;
        elseif($status == 'enroute-market'):
            $batch = secure($_POST['batch']);
            $stat = 'Runner is on the way to the market';
            $updateStats = $conn->query("UPDATE requestStatus SET status = '$status', remark = '$stat' WHERE batch = '$batch' ");
            if($updateStats):
                echo "
                    <script>
                        alert('Errand status has been updated')
                        window.open('$origin', '_self');
                    </script>
                ";
            else:
                echo $conn->error;
            endif;
        elseif($status == 'picking-up'):
            $batch = secure($_POST['batch']);
            $pickTime = date('Y-m-d H:i:s');
            $stat = 'Runner has picked up items from the market';
            $updateStats = $conn->query("UPDATE requestStatus SET status = '$status', remark = '$stat', pickupTime = '$pickTime' WHERE batch = '$batch' ");
            if($updateStats):
                echo "
                    <script>
                        alert('Errand status has been updated')
                        window.open('$origin', '_self');
                    </script>
                ";
            else:
                echo $conn->error;
            endif;
        elseif($status == 'delivering'):
            $batch = secure($_POST['batch']);
            $stat = 'Runner is on the way to you with your items';
            $updateStats = $conn->query("UPDATE requestStatus SET status = '$status', remark = '$stat' WHERE batch = '$batch' ");
            if($updateStats):
                echo "
                    <script>
                        alert('Errand status has been updated')
                        window.open('$origin', '_self');
                    </script>
                ";
            else:
                echo $conn->error;
            endif;
        elseif($status == 'completed'):
            $batch = secure($_POST['batch']);
            $pickTime = date('Y-m-d H:i:s');
            $available = 'available';
            $runner = $_SESSION['email'];
            $stat = 'Runner has delivered items to your delivery address';
            $query = $conn->query("UPDATE runners SET availability = '$available' WHERE email = '$runner' ");
            $updateStat = $conn->query("UPDATE requests SET deliveredAt = '$pickTime' WHERE batch = '$batch' ");
            $updateStats = $conn->query("UPDATE requestStatus SET status = '$status', remark = '$stat', completedAt = '$pickTime' WHERE batch = '$batch' ");
            if($query && $updateStat && $updateStats):
                echo "
                    <script>
                        alert('Errand status has been updated')
                        window.open('$origin', '_self');
                    </script>
                ";
            else:
                echo $conn->error;
            endif;
        endif;
    endif;
}

function calcDiscount($status, $runner)
{
    global $conn;
    $query = $conn->query("SELECT SUM(amount) as totalSales FROM requests WHERE status = '$status' AND runner = '$runner' ");
    if($query):
        $disc = 5/100;
        $sales = $query->fetch_assoc();
        $runnerSales = $sales['totalSales'];
        $commission = $disc * $runnerSales;
        return $commission;
    endif;
}
function addToCart($item)
{
    global $conn;
    if(isset($_POST['addCart-m-'.$item])):
        $quantity = secure($_POST['quantity']);
        $price = secure($_POST['price']);
        $market = secure($_POST['market']);
        $amount = $quantity * $price;
        $user = userDetails()['id'];
        $session = session_id();
        $checkCart = countAnd('requests', 'session', '=', $session, 'item', '=', $item);
        if ($checkCart > 0):
            $query = $conn->query("UPDATE requests SET quantity = quantity + '$quantity', amount = amount + '$amount' WHERE session = '$session' AND item = '$item' ");
            if($query):
                $origin = $_SERVER['HTTP_REFERER'];
                echo "<script>window.open('/market/$market', '_self')</script>";
            else:
                echo $conn->error;
            endif;
        else:
            $query = $conn->query("INSERT INTO requests (item, price, quantity, amount, market, user, session) VALUES ('$item', '$price', '$quantity', '$amount', '$market', '$user', '$session') ");
            if($query):
                echo "<script>window.open('/market/$market', '_self')</script>";
            else:
                echo $conn->error;
            endif;
        endif;
    endif;
}

function addWToCart($item)
{
    global $conn;
    if(isset($_POST['addCart-w-'.$item])):
        $quantity = secure($_POST['quantity']);
        $price = secure($_POST['price']);
        $market = secure($_POST['market']);
        $amount = $quantity * $price;
        $user = userDetails()['id'];
        $session = session_id();
        $checkCart = countAnd('requests', 'session', '=', $session, 'item', '=', $item);
        if ($checkCart > 0):
            $query = $conn->query("UPDATE requests SET quantity = quantity + '$quantity', amount = amount + '$amount' WHERE session = '$session' AND item = '$item' ");
            if($query):
                $origin = $_SERVER['HTTP_REFERER'];
                echo "<script>window.open('/market/$market', '_self')</script>";
            else:
                echo $conn->error;
            endif;
        else:
            $query = $conn->query("INSERT INTO requests (item, price, quantity, amount, market, user, session) VALUES ('$item', '$price', '$quantity', '$amount', '$market', '$user', '$session') ");
            if($query):
                $origin = basename($_SERVER['HTTP_REFERER']);
                echo "<script>window.open('/market/$market', '_self')</script>";
            else:
                echo $conn->error;
            endif;
        endif;
    endif;
}

function updateCart($item)
{
    global $conn;
    if(isset($_POST['updateCart'.$item])):
        $quantity = secure($_POST['quantity']);
        $price = secure($_POST['price']);
        $amount = $quantity * $price;
        $session = session_id();
        $query = $conn->query("UPDATE requests SET quantity = '$quantity', amount = '$amount' WHERE session = '$session' AND item = '$item' ");
        if($query):
            $origin = $_SERVER['HTTP_REFERER'];
            echo "<script>window.open('$origin', '_self')</script>";
        else:
            echo $conn->error;
        endif;
    endif;
}

function itemDetails($item)
{
    global $conn;
    $query = $conn->query("SELECT * FROM items WHERE id = '$item' ");
    if($query):
        $item = $query->fetch_assoc();
        return $item;
    else:
        echo $conn->error;
    endif;
}

function marketDetails($item)
{
    global $conn;
    $query = $conn->query("SELECT * FROM markets WHERE id = '$item' ");
    if($query):
        $item = $query->fetch_assoc();
        return $item;
    else:
        echo $conn->error;
    endif;
}

function runnerDetails($runner, $table)
{
    global $conn;
    $query = $conn->query("SELECT * FROM $table WHERE id = '$runner' ");
    if($query):
        $item = $query->fetch_assoc();
        return $item;
    else:
        echo $conn->error;
    endif;
}

function deleteItem($item)
{
    global $conn;
    if (isset($_POST['delete'.$item])) {
        $session = session_id();
        $query = $conn->query("DELETE FROM requests WHERE id = '$item' ");
        if($query):
            $origin = $_SERVER['HTTP_REFERER'];
            echo "<script>window.open('$origin', '_self')</script>";
        else:
            echo $conn->error;
        endif;
    }
}

function makePayment()
{
    global $conn;
    if (isset($_POST['makePayment'])):
        $session = session_id();
        $ref = mt_rand();
        $user = $_SESSION['email'];
        $amount = getTotal('requests', 'amount', 'session', '=', $session);
        $requestDetails = groupBy('requests', 'market');
        $runners = countWhere('runners','availability', '=', 'available');
        if ($runners > 0):
            $apikey = 'sk_test_a63ff5b2c8ef23d8ea4e3b6631681767d2465549';
            $paystack = new Yabacon\Paystack($apikey);
            try
            {
                $tranx = $paystack->transaction->initialize([
                    'amount'=>$amount * 100,       // in kobo
                    'email'=>$user,         // unique to customers
                    'reference'=>$ref // unique to transactions
                ]);
                
            } 
            catch(\Yabacon\Paystack\Exception\ApiException $e){
                print_r($e->getResponseObject());
                die($e->getMessage());
            }
            if($tranx->data->reference ):
                $trans = $tranx->data->authorization_url;
                $_SESSION['batch'] = $ref;
                $update = $conn->query("UPDATE requests SET batch = '$ref' WHERE session = '$session' ");
                echo "<script>window.open('$trans', '_self')</script>";
            else:
                echo "Payment Error";
            endif;
        else:
            echo "<script>alert('$lga No runners available')</script>";
        endif;
    endif;
}
