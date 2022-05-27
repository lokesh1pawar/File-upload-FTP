<?php
echo 'Start Process.../n';


error_reporting(-1);
ini_set('display_errors', 'On');

$rootDir = realpath($_SERVER["DOCUMENT_ROOT"])."/FTP_OPEN_PHP";

$localFilePath =  $rootDir."/sam.txt";
$serverPath = 'test/filenameQQQQ.txt';
$ftp_host   = 'ftp.unifirstfirstaidandsafety.com';
$ftp_username = 'unifirstdev@dev.unifirstfirstaidandsafety.com';
$ftp_password = 'ta]FrcRDV!&w';
$ftp_port = 21;


// Example 1
$ch = curl_init();
$fp = fopen($localFilePath, 'r');
curl_setopt($ch, CURLOPT_URL, "ftp://$ftp_username:$ftp_password@$ftp_host:$ftp_port/".$serverPath);
curl_setopt($ch, CURLOPT_UPLOAD, 1);
curl_setopt($ch, CURLOPT_INFILE, $fp);
curl_setopt($ch, CURLOPT_INFILESIZE, filesize($localFilePath));
curl_exec ($ch);
$error_no = curl_errno($ch);
curl_close ($ch);
if ($error_no == 0) {
    $error = 'File uploaded succesfully.';
} else {
    $error = 'File upload error.';
}


// Example 2
function uploadFTP($server, $username, $password, $local_file, $remote_file){
    // connect to server
    $connection = ftp_connect($server);
    // login
    if (@ftp_login($connection, $username, $password)){
        echo "successfully connected";
    }else{
        return false;
    }
    ftp_put($connection, $remote_file, $local_file, FTP_BINARY);
    ftp_close($connection);
    return true;
}

uploadFTP($ftp_host, $ftp_username, $ftp_password, $localFilePath, $serverPath);




?>