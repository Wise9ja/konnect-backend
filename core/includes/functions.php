<?php
ob_start();
error_reporting(1);
// ini_set('display_errors', 'on');
session_start();
$connn = null;
ini_set( 'upload_max_size' , '100M' );
ini_set( 'post_max_size', '100M');
ini_set( 'max_execution_time', '0' );
function connect($host,$database_username,$database_password,$database_name)
{  
    global $connn;
    $connn = mysqli_connect($host,$database_username,$database_password,$database_name,'3306');
    $con = $connn;
$database = mysqli_select_db($connn,$database_name) or die('database error');

if($database)
   {
    // print_r($connn);
   }
   else
   {
 echo 'fvgvgsvvv';

   }
   

}

function update2($table, $cond1, $cond2,$cond3,$cond4, $cnames, $values)
{
    global $connn;
    $key = count($cnames);
    $stm = "";
    if (is_array($cnames)) {
        for ($a = 0; $a < $key; $a++) {
            if ($a == $key - 1) {
                $stm .= $cnames["$a"] . "=" . "'" . $values["$a"] . "'";
            }
            else {
                $stm .= $cnames["$a"] . "=" . "'" . $values["$a"] . "'" . ",";
            }

        }

    }
    else {
        $stm = $cnames . "=" . "'" . $values . "'";
       
    }
     $stmt = " UPDATE $table  SET $stm  WHERE $cond1 = '$cond2' AND $cond3 = '$cond4' ";
   // echo '<br>';
    $query = mysqli_query($connn, $stmt);
}

function update ($table,$cond1,$cond2,$cnames,$values)
{
    global $connn;
    $key = count($cnames);
    $stm = "";
    if(is_array($cnames) )
    {
    for ($a=0;$a<$key;$a++)
    {
       if($a == $key-1)
       {
           $stm.= $cnames["$a"]."="."'".$values["$a"]."'";
       }
        else
        {
            $stm.= $cnames["$a"]."="."'".$values["$a"]."'".",";
        }

    }
    $stmt = " UPDATE $table  SET $stm  WHERE $cond1 = '$cond2' ";

    }
    else
    {
        $stm = $cnames."="."'".$values."'";
      $stmt = " UPDATE $table  SET $stm  WHERE $cond1 = '$cond2' ";
    }
    $query = mysqli_query($connn, $stmt);
}


function insert ($table,$cnames,$values)
{
    global $connn;
    $key = count($cnames);
    $n = "";
    $v = "";
    if(is_array($cnames))
    {
    for ($a=0;$a<$key;$a++)
    {
        if($a == $key-1)
        {
            $n.= $cnames["$a"].")";
            $v.=  "'".$values["$a"]."')";
        }
        elseif($a == 0)
        {
           $n.="(".$cnames["$a"].",";
          $v.= "('".$values["$a"]."',";
        }
        else
        {
            $n.=$cnames["$a"].",";
            $v.= "'".$values["$a"]."',";
        }


    }

    }
    else
    {
        $n = "(".$cnames.")";
        $v = "( '".$values."' )";
    }
     $stmt = " INSERT INTO $table $n VALUES $v ";
//echo $stmt;
     $query = mysqli_query($connn,$stmt);
//echo $stmt;
//die();

}
function format_date($str) {
    $month = array(" ", "Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec");
    $y = explode(' ', $str);
    $x = explode('-', $y[0]);
    $date = "";
    $m = (int)$x[1];
    $m = $month[$m];
    $st = array(1, 21, 31);
    $nd = array(2, 22);
    $rd = array(3, 23);
    if(in_array( $x[2], $st)) {
        $date = $x[2].'st';
    }
    else if(in_array( $x[2], $nd)) {
        $date .= $x[2].'nd';
    }
    else if(in_array( $x[2], $rd)) {
        $date .= $x[2].'rd';
    }
    else {
        $date .= $x[2];
    }
    $date .= ' ' . $m . ', ' . $x[0];

    return $date;
}
function select ($column_names,$table_name,$orderby=null,$orderv=null,$limit=null,$condition=null,$condition_value=null,$additional_condition=null,$additional_value=null)
{ global $connn;
   
    if(is_array($column_names))
    {
        $value = "";
        $key = count($column_names);
    for($a=0;$a<$key;$a++)
    {

     if($a == 0)
        {

           $value .= $column_names["$a"];
        }
        else
        {
            $value .=",".$column_names["$a"];
        }
    }

    }
    else
    {
        $value = $column_names;
    }
    $statement = "SELECT $value FROM $table_name ";
if($condition_value!=null)
{
    $statement .= "WHERE $condition = '$condition_value' ";
}

    if($condition_value!=null && $additional_value!=null)
    {
        $statement.="AND $additional_condition = '$additional_value'";
    }
    if($orderby!=null )
    {
       $statement.=" ORDER BY $orderby $orderv ";
    }
    if($limit!=null)
    {
         $statement.=" LIMIT $limit ";
    }
    // echo $statement;
       $prepared_query = mysqli_query($connn,$statement);
    //   print_r($prepared_query);
    $rrr = mysqli_fetch_assoc ($prepared_query);
  
return $rrr;


    }
function select_nofetch ($column_names,$table_name,$orderby=null,$orderv=null,$limit=null,$condition=null,$condition_value=null,$additional_condition=null,$additional_value=null)
{ global $connn;

    if(is_array($column_names))
    {
        $value = "";
        $key = count($column_names);
        for($a=0;$a<$key;$a++)
        {

            if($a == 0)
            {

                $value .= $column_names["$a"];
            }
            else
            {
                $value .=",".$column_names["$a"];
            }
        }

    }
    else
    {
        $value = $column_names;
    }
    $statement = "SELECT $value FROM $table_name ";
    if($condition_value!=null)
    {
        $statement .= "WHERE $condition = '$condition_value' ";
    }

    if($condition_value!=null && $additional_value!=null)
    {
        if($additional_value=="nott")
        {
            $statement .= "AND $additional_condition = ''";

        }else {
            $statement .= "AND $additional_condition = '$additional_value'";
        }
    }

    if($orderby!=null )
    {
        $statement.=" ORDER BY $orderby $orderv";
    }

    if($limit!=null)
    {
        $statement.=" LIMIT $limit ";
    }


  // echo $statement;
   $prepared_query = mysqli_query($connn,$statement);
   $prepared_query;
    return $prepared_query;



}

function select_nofetch_between ( $column_names,  $table_name,$orderby=null,$orderv=null,$limit=null,$condition=null,$condition_value=null,$additional_condition=null,$additional_value=null,$between=null,$between2=null)
{ global $connn;

    if(is_array($column_names))
    {
        $value = "";
        $key = count($column_names);
        for($a=0;$a<$key;$a++)
        {

            if($a == 0)
            {

                $value .= $column_names["$a"];
            }
            else
            {
                $value .=",".$column_names["$a"];
            }
        }

    }
    else
    {
        $value = $column_names;
    }
    $statement = "SELECT $value FROM $table_name ";
    if($condition_value!=null)
    {
        $statement .= "WHERE $condition = '$condition_value' ";
    }

    if($condition_value!=null && $additional_value!=null)
    {
        $statement.="AND ($additional_condition = '$additional_value') ";
    }

    if($between!=null && $between2!=null && $additional_condition!=null && $condition=="nott")
    {
        $statement.="WHERE  $additional_condition BETWEEN '$between' AND '$between2' ";
    }
elseif($between!=null && $between2!=null && $additional_condition!=null && $condition!="nott" )
    {
        $statement.=" AND  ($additional_condition BETWEEN '$between' AND '$between2' )";
    }



    if($orderby!=null )
    {
        $statement.=" ORDER BY $orderby $orderv";
    }

    if($limit!=null)
    {
        $statement.=" LIMIT $limit ";
    }




     $prepared_query = mysqli_query($connn,$statement);
  //echo $statement;
    return $prepared_query;



}


function select_nofetch_between2 ( $column_names,  $table_name,$orderby=null,$orderv=null,$limit=null,
                                   $condition=null,$condition_value=null,$additional_condition=null,$additional_value=null,$between=null,$between2=null)

{ global $connn;

    if(is_array($column_names))
    {
        $value = "";
        $key = count($column_names);
        for($a=0;$a<$key;$a++)
        {

            if($a == 0)
            {

                $value .= $column_names["$a"];
            }
            else
            {
                $value .=",".$column_names["$a"];
            }
        }

    }
    else
    {
        $value = $column_names;
    }
    $statement = "SELECT $value FROM $table_name ";
    if($condition_value!=null)
    {
        $statement .= "WHERE $condition = '$condition_value' ";
    }

    if($condition_value!=null && $additional_value!=null)
    {
        $statement.="AND ($additional_condition = '$additional_value') ";
    }

    if($between!=null && $between2!=null && $additional_condition!=null && $condition=="nott")
    {
       // $statement.="WHERE  $additional_condition BETWEEN '$between' AND '$between2' ";
        $statement.=" WHERE str_to_date($additional_condition,'%d/%m/%Y')  BETWEEN str_to_date('$between',
        '%d/%m/%Y') AND str_to_date('$between2','%d/%m/%Y')  ";
    }
    elseif($between!=null && $between2!=null && $additional_condition!=null && $condition!="nott" )
    {
        $statement.=" AND  ( str_to_date($additional_condition,'%d/%m/%Y')  BETWEEN str_to_date('$between',
        '%d/%m/%Y') AND str_to_date('$between2','%d/%m/%Y') ) ";
    }



    if($orderby!=null )
    {
        $statement.=" ORDER BY $orderby $orderv";
    }

    if($limit!=null)
    {
        $statement.=" LIMIT $limit ";
    }


    $prepared_query = mysqli_query($connn,$statement);
    //echo $statement;
    return $prepared_query;



}

function search_data ($column_names,$table_name,$orderby=null,$orderv=null,$limit=null,$condition,$condition_value)
{ global $connn;

    if(is_array($column_names))
    {
        $value = "";
        $key = count($column_names);
        for($a=0;$a<$key;$a++)
        {

            if($a == 0)
            {

                $value .= $column_names["$a"];
            }
            else
            {
                $value .=",".$column_names["$a"];
            }
        }

    }
    else
    {
        $value = $column_names;
    }


    $statement = "SELECT $value FROM $table_name ";

    if(is_array($condition))
    {
        $value = "";
        $key = count($condition);
        for($a=0;$a<$key;$a++)
        {

            if($a == 0)
            {
                if($condition_value!=null)
                {
                    $statement .= "WHERE $condition[$a] LIKE '%".$condition_value."%' ";
                }

            }
            else
            {  if($condition_value!=null) {
                $statement .= " OR $condition[$a] LIKE '%".$condition_value."%'  ";
            }
            }
        }

    }
    else
    {
        $statement .= "WHERE $condition LIKE '%".$condition_value."%'  ";

    }


    if($orderby!=null )
    {
        $statement.=" ORDER BY $orderby $orderv ";
    }
    if($limit!=null)
    {
        $statement.=" LIMIT $limit ";
    }
    $prepared_query = mysqli_query($connn,$statement);

    return $prepared_query;


}

function make_thumb($src, $dest, $desired_width,$desired_height) {

    /* read the source image */
    $info = pathinfo($src);

    $extension = strtolower($info['extension']);
    if (in_array($extension, array('jpg', 'jpeg', 'png', 'gif'))) {

        switch ($extension) {
            case 'jpg':
                $source_image = imagecreatefromjpeg($src);

                $width = imagesx ($source_image);
                $height = imagesy  ($source_image);
                /* find the "desired height" of this thumbnail, relative to the desired width  */
              //  $desired_height = floor($height * ($desired_width / $width));
                /* create a new, "virtual" image */
                $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

                /* copy source image at a resized size */
                imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
                /* create the physical thumbnail image to its destination */
                @imagejpeg($virtual_image, $dest);
                break;

            case 'jpeg':
                $source_image = imagecreatefromjpeg($src);

                $width = imagesx ($source_image);
                $height = imagesy  ($source_image);
                /* find the "desired height" of this thumbnail, relative to the desired width  */
                $desired_height = floor($height * ($desired_width / $width));
                /* create a new, "virtual" image */
                $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

                /* copy source image at a resized size */
                imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
                /* create the physical thumbnail image to its destination */
                @imagejpeg($virtual_image, $dest);
                break;

            case 'png':
                $source_image = imagecreatefrompng($src);
                $width = imagesx ($source_image);
                $height = imagesy  ($source_image);
                /* find the "desired height" of this thumbnail, relative to the desired width  */
                $desired_height = floor($height * ($desired_width / $width));
                /* create a new, "virtual" image */
                $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

                imagealphablending($virtual_image, false);
                imagesavealpha($virtual_image,true);
                $transparent = imagecolorallocatealpha($virtual_image, 255, 255, 255, 127);
                imagefilledrectangle($virtual_image, 0, 0, $desired_width, $desired_height, $transparent);

                /* copy source image at a resized size */
                imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
                /* create the physical thumbnail image to its destination */
                @imagepng($virtual_image, $dest);

                break;

            case 'gif':
                $source_image = imagecreatefromgif($src);
                $width = imagesx ($source_image);
                $height = imagesy  ($source_image);
                /* find the "desired height" of this thumbnail, relative to the desired width  */
                $desired_height = floor($height * ($desired_width / $width));
                /* create a new, "virtual" image */
                $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

                /* copy source image at a resized size */
                imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
                /* create the physical thumbnail image to its destination */
                @imagegif($virtual_image, $dest);
                break;
            default:

                $source_image = imagecreatefromjpeg($src);
                $width = imagesx ($source_image);
                $height = imagesy  ($source_image);
                /* find the "desired height" of this thumbnail, relative to the desired width  */
                $desired_height = floor($height * ($desired_width / $width));
                /* create a new, "virtual" image */
                $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

                /* copy source image at a resized size */
                imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
                /* create the physical thumbnail image to its destination */
                @imagejpeg($virtual_image, $dest);
        }

    }

}
 function delete($table,$condition,$id)
 {
     global $connn;
     $stmt = "DELETE FROM $table WHERE $condition = '$id' ";
     $query = mysqli_query($connn,$stmt);

 }

function delete_above($table,$condition,$id)
{
    global $connn;
    $stmt = "DELETE FROM $table WHERE $condition >= '$id' ";
    $query = mysqli_query($connn,$stmt);

}

 ?>
