<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../../inc/db.php';
$count="";
$sql_demmande="SELECT * FROM `demmande_operataion` JOIN patient on patient.id_patient=demmande_operataion.id_patient JOIN medcin on medcin.id_medcin=demmande_operataion.id_medcin  WHERE demmande_operataion.etat=0";
if (mysqli_query($conn,$sql_demmande))
{
    $result = mysqli_query($conn,$sql_demmande);
    $demmandes=mysqli_fetch_all($result, MYSQLI_ASSOC);
    $count=mysqli_num_rows($result);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

if(isset($_POST["organiser_operation"]))
{
        $id_demmande=$_POST["organiser_operation"];
        $_SESSION['id_demande_op']=$_POST["organiser_operation"];
        $sql_demmandes_op="SELECT * FROM demmande_operataion WHERE demmande_operataion.id_demmande='$id_demmande'";

        if (mysqli_query($conn,$sql_demmandes_op))
        {
            $result = mysqli_query($conn,$sql_demmandes_op);
            $demmandes_op=mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            foreach($demmandes_op as $demmande_op)
            {
                $_SESSION['id_medcin'] = $demmande_op['id_medcin'];
                $_SESSION['id_patient'] = $demmande_op['id_patient'];
                $_SESSION['duree']=$demmande_op['duree'];
            }
            header("location:../ajouter_operation/date.php");
            exit();
        }else 
        { 
            echo ("error" . mysqli_error($conn) );
        }  
}


?>
