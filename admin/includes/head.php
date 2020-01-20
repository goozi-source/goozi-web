<?php 
    header('Cache-Control: max-age='.(5184000 * 3).', must-revalidate');
    $lastModified=filemtime($_SERVER['SCRIPT_FILENAME']);
    //get a unique hash of this file (etag)
    $etagFile = md5_file($_SERVER['SCRIPT_FILENAME']);
    //get the HTTP_IF_MODIFIED_SINCE header if set
    $ifModifiedSince=(isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false);
    //get the HTTP_IF_NONE_MATCH header if set (etag: unique file hash)
    $etagHeader=(isset($_SERVER['HTTP_IF_NONE_MATCH']) ? trim($_SERVER['HTTP_IF_NONE_MATCH']) : false);

    //set last-modified header
    header("Last-Modified: ".gmdate("D, d M Y H:i:s", $lastModified)." GMT");
    //set etag-header
    header("Etag: $etagFile");
    //make sure caching is turned on
    header('Cache-Control: public');
    //check if page has changed. If not, send 304 and exit
    if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE'])==$lastModified || $etagHeader == $etagFile)
    {
           header("HTTP/1.1 304 Not Modified");
           exit;
    }
    session_start();
    include '../functions/function.php';
    $admin = 'admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= AppName() ?> - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="/admin/css/sb-admin-2.css" rel="stylesheet">

</head>