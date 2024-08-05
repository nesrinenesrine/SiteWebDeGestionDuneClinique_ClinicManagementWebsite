<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../../inc/db.php';
$id_service=$_SESSION['service'];
$id_chef_service=$_SESSION['userId'];
$qsl_medecin="SELECT * FROM `medcin` 
WHERE medcin.id_specialite = '$id_service' ";
if (mysqli_query($conn,$qsl_medecin))
{
    $result = mysqli_query($conn,$qsl_medecin);
    $medecins=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}
if(isset($_POST['fcihe_medecin']))
{
    $_SESSION['id_medecin']=$_POST['fcihe_medecin'];
    header("location:fcihe_medecin.php");
}
?>

