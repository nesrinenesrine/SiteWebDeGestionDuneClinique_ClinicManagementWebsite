<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../../inc/db.php';

$sql="SELECT * FROM patient ";
if (mysqli_query($conn,$sql))
{
    $result = mysqli_query($conn,$sql);
    $patients=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

if(isset($_POST['fiche_patient']))
{
    $_SESSION['id_patient'] = $_POST['fiche_patient'];
    header("location:fiche_patient.php");
}




?>

