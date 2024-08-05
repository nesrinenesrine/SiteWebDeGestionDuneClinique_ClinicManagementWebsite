<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../../inc/db.php';
$id=$_SESSION['userId'];

$sql_operation="SELECT * FROM `operation` join patient on operation.id_patient=patient.id_patient WHERE operation.id_medcin='$id';";
if (mysqli_query($conn,$sql_operation))
{
    $result = mysqli_query($conn,$sql_operation);
    $operations=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

?>
