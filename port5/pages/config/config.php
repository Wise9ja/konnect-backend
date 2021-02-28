<?php
 define("DB_HOST","mysql.konnect.link");
 define("USERNAME","davis_567");
 define("PASS","Davis_567_2020");
 define("DBNAME","konnect");
 define("DB_TYPE","mysql");
 define("PORT","3306");
$con=mysqli_connect(DB_HOST,USERNAME,PASS, DBNAME);
if(!$con)
{die('could not connect to server:'.mysql_error());}

?>