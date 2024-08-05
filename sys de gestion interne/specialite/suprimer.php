<?php 
session_start();
include '../../inc/db.php';

$id_sep=$_SESSION['id_sep'];

$sql_supp_spe="DELETE FROM `specialite` WHERE specialite.id_specialite='$id_sep'";
if (mysqli_query($conn,$sql_supp_spe))
{
    $sql_supp_med="DELETE FROM `medcin` WHERE medcin.id_specialite='$id_sep'";
    if (mysqli_query($conn,$sql_supp_med))
    {
        header("location:../profile_admin/profil_admin.php");
        exit();
    }
    else 
    { 
        echo ("error" . mysqli_error($conn) );
    }
    exit();
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

?>