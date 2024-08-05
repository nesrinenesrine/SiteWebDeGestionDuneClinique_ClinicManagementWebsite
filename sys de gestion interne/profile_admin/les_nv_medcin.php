<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../../inc/db.php';


$sql_nv_medcin="SELECT * FROM nv_medcin";
if (mysqli_query($conn,$sql_nv_medcin))
{
    $result = mysqli_query($conn,$sql_nv_medcin);
    $nv_medcins=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

if(isset($_POST["affecter_emploi"]))
{
    $id=$_POST["affecter_emploi"];
    $sql_nv_medcin="SELECT * FROM nv_medcin WHERE nv_medcin.id='$id'" ;
    if (mysqli_query($conn,$sql_nv_medcin))
    {
        $result = mysqli_query($conn,$sql_nv_medcin);
        $nv_medcin=mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach($nv_medcin as $nv)
        {
            $_SESSION['id'] = $nv['id'];
            $_SESSION['nom_nv_medcin']=$nv['nom'];
            $_SESSION['prenom_nv_medcin']=$nv['prenom'];
            $_SESSION['nv_username']=$nv['username'];
            $_SESSION['id_specialite']=$nv['id_specialite'];
            $_SESSION['nv_email']=$nv['email'];
            $_SESSION['nv_telephone']=$nv['telephone'];
            $_SESSION['nv_mot_de_passe']=$nv['mot_de_passe'];
        }
        header("location:../affecter_emploi.php");
        exit();
    }else 
    { 
        echo ("error" . mysqli_error($conn) );
    }  
}

?>