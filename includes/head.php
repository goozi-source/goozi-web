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
    include './functions/function.php';
    $admin = 'admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo AppName();?></title>
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#c77104">
    <meta name="msapplication-TileColor" content="#c77104">
    <meta name="msapplication-TileImage" content="/img/icon-144x144.png">
    <meta name="apple-mobile-web-app-status-bar-style" content="#c77104">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    <meta name="apple-mobile-web-app-status-bar-style" content="default"> 
    <link rel="apple-touch-icon" href="/img/icon.png">                          
    <link rel="apple-touch-icon" sizes="72x72" href="/img/icon-72x72.png">
    <link rel="apple-touch-icon" sizes="96x96" href="/img/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/icon-192x192.png">
    <link rel="apple-touch-startup-image" href="/img/icon.png">
    <link rel="icon" type="image/png" href="/img/icon.png">
    
    
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/mdb.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple|3d|anaglyph|3d-float" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500" rel="stylesheet">
    <link href="/css/lightbox.min.css" rel="stylesheet">
    <?php if(preg_match("/{$admin}/i", $_SERVER['REQUEST_URI'])): ?>
      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <?php endif ?>
    
    <style type="text/css">
      @media (min-width: 800px) and (max-width: 850px) {
              .navbar:not(.top-nav-collapse) {
                  background: #00008b!important;
              }
          }
        /* width */
        ::-webkit-scrollbar {
          width: 5px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
          box-shadow: inset 0 0 5px #00008b; 
          border-radius: 10px;
        }
         
        /* Handle */
        ::-webkit-scrollbar-thumb {
          background: #c77104; 
          border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
          background: #00008b; 
        }

        ::-moz-scrollbar {
          width: 5px;
        }

        /* Track */
        ::-moz-scrollbar-track {
          box-shadow: inset 0 0 5px #00008b; 
          border-radius: 10px;
        }
         
        /* Handle */
        ::-moz-scrollbar-thumb {
          background: #c77104; 
          border-radius: 10px;
        }

        /* Handle on hover */
        ::-moz-scrollbar-thumb:hover {
          background: #00008b; 
        }
    </style>
</head>

