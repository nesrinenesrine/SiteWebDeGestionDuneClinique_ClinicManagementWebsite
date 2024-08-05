<?php 

include '../../inc/db.php';
$sql_ajoute_seps="SELECT * FROM `specialite` ";
if (mysqli_query($conn,$sql_ajoute_seps))
{
    $result = mysqli_query($conn,$sql_ajoute_seps);
    $specialites=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

?>

