<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../../inc/db.php';

$sql="SELECT * FROM `operation` 
join medcin on operation.id_medcin=medcin.id_medcin 
JOIN patient on operation.id_patient=patient.id_patient ";
if (mysqli_query($conn,$sql))
{
    $result = mysqli_query($conn,$sql);
    $operations=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

if(isset($_POST['modifie']))
{
    $_SESSION['op_modif']=$_POST['modifie'];
    header("location:./modif operation/date.php");
}

if(isset($_POST['suprimer']))
{
    echo $_POST['suprimer'];
}
?>

