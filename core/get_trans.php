<?php
include "includes/con.php";

$user = $_GET['user'];


 $sqlx =$con->query("SELECT * FROM wallet WHERE user='$user'");
 $rowx = mysqli_fetch_array($sqlx);
{
$balance = number_format($row['balance']);
}       

$balance = "&#8358;".$balance;

 $sql ="SELECT * FROM wallet_trans WHERE user='$user'";
        $sql1 = $con->query($sql);
        $countx = mysqli_num_rows($sql1);

        if($countx >= 1)
        {
        while ($row = mysqli_fetch_array($sql1))
        {
        $trans_id = $row['trans_id'];
        $trans_ref = $row['trans_ref'];
        $amount = number_format($row['amount']);
        $trans_type = $row['type'];
        $method = $row['method'];
        $status = $row['status'];
        $prev_bal = $row['prev_bal'];
        $new_bal = $row['new_bal'];
        $date_t = $row['date_t'];

        $date_t = date('j/m',strtotime('+0 days',strtotime(str_replace('/', '-', $date_t))));
     
         
         $amount = "&#8358;".$amount;


        if($trans_type == "WFund")
        {
          $in = $amount;
          $out = "";
        }

        else if ($trans_type == "WPayout")
        {
          $in = "";
          $out = $amount;
        }
        
        
        $trans .=   '<tr>
                        <td>'.$date_t.'</td>
                        <td>'.$method.'</td>
                        <td>'.$in.'</td>
                        <td>'.$out.'</td>
                        <td>'.$new_bal.'</td>
                    </tr>';

    
                 } 
        }
        else
        {
            $notrans = "No transaction at the moment";
        } 
      

$output = array('trans' => $trans, 'notrans' => $notrans, 'bal' => $balance);
echo $_GET['callback']."(".json_encode($output).")"; //output JSON data
