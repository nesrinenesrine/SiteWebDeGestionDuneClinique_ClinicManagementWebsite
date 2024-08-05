<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../../inc/db.php';
$id=$_SESSION['userId'];
$date=date('y-m-d');

$sql_rdv=" SELECT * FROM `rdv` 
JOIN patient ON patient.id_patient =rdv.id_patient and rdv.id_medcin='$id' 
join time on time.id_time=rdv.id_time
WHERE rdv.date >='$date'";

if (mysqli_query($conn,$sql_rdv))
{
    $result = mysqli_query($conn,$sql_rdv);
    $rdvs=mysqli_fetch_all($result, MYSQLI_ASSOC);
    
}else
{
    echo ("error" . mysqli_error($conn));
}

?>

