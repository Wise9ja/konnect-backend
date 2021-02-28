<?php
include "includes/con.php";

$user = $_GET['user'];
$inv_num = $_GET['inv_num'];

$sql2 = $con->query("SELECT * FROM sales  WHERE inv_num ='$inv_num' AND user = '$user'");

        $row2 = mysqli_fetch_array($sql2);
        
        $total = $row2['total'];
        //$credit = $row2['credit'];
       

       $sqlc = $con->query("SELECT * FROM kredit  WHERE user ='$user'");

        $rowc = mysqli_fetch_array($sqlc);
        $kredit_status = $rowc['status'];
        $credit = $rowc['credit'];
        
         $credit_r = 0.1 * $total; 
         $credit_bal = 100000 - $credit;

         if($credit_bal >= $credit_r)
         {
                $kredit = $credit_r;
         }
         else if ($credit_bal >= 0 && $credit_bal < $credit_r)
         {
                $kredit = $credit_bal;
         }
         else
         {
           $kredit = 0;
         }

        if($kredit_status == "Active" && $credit_bal >= 0)
        {
            $kredit_stat = "Active";
            $kredit = $credit_r;
        }
        else
        {
            $kredit = 0;
        }
        
        $credit_bal = $credit - $kredit;

       
$sqlx = $con->query("UPDATE sales SET credit = '$kredit' WHERE  inv_num = '$inv_num' AND  user ='$user'");
$sqlx2 = $con->query("UPDATE kredit SET credit = '$credit_bal' WHERE  user ='$user'");

if($sqlx && $sqlx2)
{
    $suc = "Yes";
}
        
$output = array('success' => $suc);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data


 
    
        
?>

