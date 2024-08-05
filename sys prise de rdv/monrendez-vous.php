<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../inc/db.php';

$id=$_SESSION['userId'];
$date=date('y-m-d');
$sql_rendez="SELECT * FROM medcin
JOIN rdv on rdv.id_medcin=medcin.id_medcin 
JOIN patient ON patient.id_patient=rdv.id_patient AND rdv.id_patient='$id' 
join time on time.id_time=rdv.id_time
WHERE rdv.date >='$date'";
if (mysqli_query($conn,$sql_rendez))
{
    $result = mysqli_query($conn,$sql_rendez);
    $sql_rendezs=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

if(isset($_POST['annuler']))
{
    $id_rdv=$_POST['annuler'];
    $sql_supp="DELETE FROM `rdv` WHERE rdv.id_rdv='$id_rdv'";
    if (mysqli_query($conn,$sql_supp))
    {
        
        exit();
    }else 
    { 
        echo ("error" . mysqli_error($conn));
    }
}

if(isset($_POST['modif_rendez']))
{
    $id_rdv=$_POST['modif_rendez'];
    $_SESSION['id_rdv']=$id_rdv;
    header("location:./modif_rdv/specialite_modif.php");
}

?>

