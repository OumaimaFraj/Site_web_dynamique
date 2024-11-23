<?php
//FOR CONNECTION
$sdb_host = 'localhost';// Adresse du serveur de base de données
$db_name = 'mysql:host=localhost;dbname=startupinvest';
$user_name = 'root';
$user_password = '';
$conn =new PDO($db_name,$user_name,$user_password);
/*$cnx=new mysqli($sdb_host,$user_name,$db_name,$user_password);

if(!$cnx){
    die(mysqli_errno($cnx));
}*/

function unique_id(){
    $chars='0123456789';
    $charLength=strlen($chars);
    $randomString='';
    for($i=0;$i<3;$i++){
        $randomString.=$chars[mt_rand(0,$charLength-1)];

    }
      // Convert the string to an integer:
    $randomInteger = intval($randomString);

    return $randomInteger;
}

?>

