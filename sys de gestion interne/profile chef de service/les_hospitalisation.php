<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../../inc/db.php';
$id_service=$_SESSION['service'];

$sql_hospi="SELECT * FROM `hospitalisation` 
JOIN patient ON patient.id_patient = hospitalisation.id_patient
WHERE hospitalisation.id_service='$id_service'";
if (mysqli_query($conn,$sql_hospi))
{
    $result = mysqli_query($conn,$sql_hospi);
    $hospitalisations=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

 if(isset($_POST['supprimer']))
{
    $id_hospi=$_POST['supprimer'];
    $sql_supp="DELETE FROM `hospitalisation` WHERE hospitalisation.id_hospitalisation='$id_hospi'";
    if (mysqli_query($conn,$sql_supp))
    {
        
        exit();
    }else 
    { 
        echo ("error" . mysqli_error($conn) );
    }

}

if(isset($_POST['modifie']))
{
    $_SESSION['id_hospitalisatation']=$_POST['modifie'];
    header("location:./modif_hospi/date.php");
}
?>
