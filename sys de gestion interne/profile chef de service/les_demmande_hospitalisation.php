<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../../inc/db.php';
$id_service=$_SESSION['service'];
$sql_dem_hsop="SELECT * FROM demmande_hospiitalisation  join patient on demmande_hospiitalisation.id_patient=patient.id_patient 
WHERE demmande_hospiitalisation.id_service='$id_service' and demmande_hospiitalisation.etat=0 ";
//ajouter service
if (mysqli_query($conn,$sql_dem_hsop))
{
    $result = mysqli_query($conn,$sql_dem_hsop);
    $dems_hsop=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

if(isset($_POST["organiser_hospitalisation"]))
{
    $id_dem_hos=$_POST["organiser_hospitalisation"];
    $_SESSION['id_hospi']=$_POST["organiser_hospitalisation"];
    $sql_dem_hsop="SELECT * FROM demmande_hospiitalisation WHERE demmande_hospiitalisation.id_dem_hos='$id_dem_hos'";
    if (mysqli_query($conn,$sql_dem_hsop))
        {
            $result = mysqli_query($conn,$sql_dem_hsop);
            $dems_hsop=mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach($dems_hsop as $dem_hsop)
            {
                $id=$dem_hsop['id_service'];
                $_SESSION['id_service'] = $id;
                $id=$dem_hsop['id_patient'];
                $_SESSION['id_patient'] = $id;
                
            }
            header("location:../organiser_hospitalisation/date.php");
            exit();
        }else 
        { 
            echo ("error" . mysqli_error($conn) );
        }  

}
?>

