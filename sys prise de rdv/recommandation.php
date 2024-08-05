<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../inc/db.php';
$sql="SELECT * FROM `recommandation`";
if(mysqli_query($conn,$sql))
{
    $result = mysqli_query($conn,$sql);
    $symps=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn));
}
if(isset($_POST['symptomes']))
{
        $sepecialite_recommander=array();
        $specialite = array_unique($_POST['option']);
        foreach($specialite as $spe)
        {
            $sql="SELECT * FROM `specialite` 
            WHERE specialite.id_specialite='$spe'";
            if(mysqli_query($conn,$sql))
                {
                    $result = mysqli_query($conn,$sql);
                    $s=mysqli_fetch_all($result, MYSQLI_ASSOC);
                    
                }else 
                { 
                    echo ("error" . mysqli_error($conn));
                }

                array_push($sepecialite_recommander,$s['0']);
        }
        $_SESSION['les_symp']=$sepecialite_recommander;
        header("location:./rendez_vous/specialite.php");
}
    
?>
