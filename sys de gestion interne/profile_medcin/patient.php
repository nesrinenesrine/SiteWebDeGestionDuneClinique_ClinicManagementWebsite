<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../../inc/db.php';

$id=$_SESSION['userId'];

$sql_patient="SELECT DISTINCT * FROM patient 
JOIN rdv on rdv.id_patient=patient.id_patient 
JOIN medcin ON medcin.id_medcin=rdv.id_medcin AND rdv.id_medcin='$id'";
if (mysqli_query($conn,$sql_patient))
{
    $result = mysqli_query($conn,$sql_patient);
    $sql_patients=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}



if(isset($_POST['fiche_patient']))
{
    $id_patient=$_POST['fiche_patient'];
    $_SESSION['id_patient']=$id_patient;
    header("location:./fiche_patient.php");
}

?>

