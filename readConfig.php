<?php
//$config = array();
if (!defined('ROOT')){
define('ROOT',str_replace("\\",'/',dirname(__FILE__)));
define('PATH', ROOT == $_SERVER['DOCUMENT_ROOT']
    ?'' :substr(ROOT,strlen($_SERVER['DOCUMENT_ROOT']))
);
}
if (trim(file_get_contents(ROOT.'/config/db.txt')) == true) {
$myFile = ROOT."/config/db.txt";
$fh = fopen($myFile, 'r');
$theData = fread($fh, filesize($myFile));
$assoc_array = array();
$my_array = explode("\n", $theData);




    if (($handle = fopen( ROOT."/config/db.txt", "r")) !== FALSE) {

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $tmp = explode(":", $data[0]);
            $assoc_array[$tmp[0]] = $tmp[1];

        }
        fclose($handle);

    }else{
        echo "Can not open file.";
    }
    $config = $assoc_array;
    /*echo $config['host'];
    echo "<br>";
    echo $config['username'];
    echo $config['password'];
    echo $config['db'];*/
}