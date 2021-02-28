<?php
include "includes/con.php";

if (isset($_GET['user']) && isset($_GET['code']))
{

    $user = $_GET['user'];
    $code=$_GET['code'];
    $date_t = date ("d-M-Y");


    $sql1=$con->query("SELECT * FROM kredit WHERE email = '$user'");
    $count1=mysqli_num_rows($sql1);

    if($count1 ==1){
        $row = mysqli_fetch_array ($sql1);
        $code2 = $row['code'];

        if($code == $code2)
        {
         
         $sqln = $con->query("UPDATE kredit set activate = 'YES', activate_date = '$date_t', status = 'Active'  WHERE email = '$user'") or die("Error2 : " . mysqli_error($con));
         $suc = "Yes";
        }

        else
    {
           $suc = "code";
      
    } 

    }  
    
    

if(isset($_GET['callback']))
{
header("Content-Type:application/json");
}

$output = array('success'=>$suc);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data

}
?>