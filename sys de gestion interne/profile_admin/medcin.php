<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../../inc/db.php';


$sql_spe="SELECT * FROM `specialite` JOIN medcin ON specialite.id_specialite=medcin.id_specialite; ";
if (mysqli_query($conn,$sql_spe))
{
    $result = mysqli_query($conn,$sql_spe);
    $med_seps=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

if(isset($_POST['submit']))
{
    $_SESSION['id_medecin']=$_POST['submit'];
    header("location:./fiche_medecin.php");
}

if(isset($_POST['chef_service']))
{
    $id=$_POST['chef_service'];
    $sql="UPDATE `medcin` SET `role` ='chef de service' WHERE medcin.id_medcin='$id'";
    if (mysqli_query($conn,$sql))
    {
        header("location:profil_admin.php");
        exit();
    }else 
    { 
        echo ("error" . mysqli_error($conn) );
    }
}

?>



