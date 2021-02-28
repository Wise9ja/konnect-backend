<?php
/**
 * Created by PhpStorm.
 * User: TONY
 * Date: 1/22/2015
 * Time: 9:21 PM
 */


if (strpos($_SERVER['HTTP_HOST'], 'konnect.link') !== false) {

//server
    $server_Address = "mysql.konnect.link";
    $dataUserName = "davis_567";
    $dataBaseName = "konnect";
    $datBaseUserPassWord = "Davis_567_2020";

}else {

//local
    $server_Address = "localhost";
    $dataUserName = "root";
    $dataBaseName = "bespoke";
    $datBaseUserPassWord = "";


}



connect($server_Address,$dataUserName,$datBaseUserPassWord,$dataBaseName);
?>
