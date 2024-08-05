<?php 

session_start();
include '../../inc/db.php';
$id_patient=$_SESSION['id_patient'];
$id_medcin=$_SESSION['userId'];
$sql_nv_rdv="SELECT * FROM `rdv` 
JOIN time ON rdv.id_time=time.id_time
WHERE rdv.id_patient ='$id_patient' and rdv.id_medcin='$id_medcin' and rdv.etat_rdv=0";

if(mysqli_query($conn,$sql_nv_rdv))
{
    $result = mysqli_query($conn,$sql_nv_rdv);
    $nv_rdvs = mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn));
}

$sql_rdv="SELECT * FROM `rdv` 
JOIN time ON rdv.id_time=time.id_time
WHERE rdv.id_patient ='$id_patient' and rdv.id_medcin='$id_medcin' and rdv.etat_rdv=1";

if(mysqli_query($conn,$sql_rdv))
{
    $result = mysqli_query($conn,$sql_rdv);
    $rdvs = mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn));
}

$sql_hospi="SELECT * FROM `hospitalisation` 
JOIN service ON hospitalisation.id_service=service.id_service 
WHERE hospitalisation.id_patient='$id_patient'";
if(mysqli_query($conn,$sql_hospi))
{
    $result = mysqli_query($conn,$sql_hospi);
    $hospitalisations = mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn));
}

$sql_operation="SELECT * FROM `operation` 
JOIN medcin ON medcin.id_medcin =operation.id_medcin and operation.id_patient='$id_patient'
JOIN specialite ON medcin.id_specialite = specialite.id_specialite;";
if(mysqli_query($conn,$sql_operation))
{
    $result = mysqli_query($conn,$sql_operation);
    $operations = mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn));
}

if(isset($_POST['rapport']))
{
    $_SESSION['id_rdv']=$_POST['rapport'];
    header("location:consultation.php");
}
//demmande 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-fichierpat.css">
    <title>fiche patient</title>
</head>
<body>
   <div class="profile">
       <a href="./profile_medcin.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
<div class="fiche">
   
    <form action="fiche_patient.php" method="post">
        <h3>Les Nouveau Rendez-Vous</h3>
        <table>
                       <thead>
                           <tr>
                             
                               <td>Date de rendez_vous</td>
                               <td>Temps de rendez_vous</td>
                               <td>le Rapport</td>

                           </tr>
                       </thead>
                       <tbody>
                       <?php foreach($nv_rdvs as $nv_rdv):?>
                            <tr>
                            
                              <td><?php echo  $nv_rdv['date'] ?></td>
                              <td><?php echo  $nv_rdv['time'] ?></td>
                              <td><button type="submit" name="rapport" value = "<?php echo $nv_rdv['id_rdv'];?> " > rapport sur la consultation </button> </td>
                              
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
    

        <h3>Les Rendez-Vous</h3>
        <table>
                       <thead>
                           <tr>
                               
                               <td>Date de rendez_vous</td>
                               <td>Temps de rendez_vous</td>
                               <td>le Rapport</td>

                           </tr>
                       </thead>
                       <tbody>
                       <?php  foreach($rdvs as $rdv) :?>
                            <tr>
                              
                              <td><?php echo  $rdv['date'] ?></td>
                              <td><?php echo  $rdv['time'] ?></td>
                              <td><button type="submit" name="rapport" value = "<?php echo $rdv['id_rdv'];?> " > consulter le rapport de la consultation </button></td>
                              
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
        

        <h3>Les Hospitalisation</h3>
        <table>
                       <thead>
                           <tr>
                               
                               <td>Date de entree</td>
                               <td>Date de sotrie</td>
                               <td>le Service</td>

                           </tr>
                       </thead>
                       <tbody>
                       <?php foreach($hospitalisations as $hospitalisation):?>
                            <tr>
                              
                              <td><?php echo  $hospitalisation['date_entre']  ?></td>
                              <td><?php echo $hospitalisation['date_sortie'] ?></td>
                              <td><?php echo $hospitalisation['nom_service'] ?></td>
                              
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
        
        

        <h3>Les Opération</h3>
        <table>
                       <thead>
                           <tr>
                               
                               <td>Nom Prénom de Médecin </td>
                               <td>le Spécialités</td>
                               <td>Date</td>

                           </tr>
                       </thead>
                       <tbody>
                       <?php foreach($operations as $operation):?>
                            <tr>
                              
                              <td><?php echo $operation['nom_medcin'] . $operation['prenom_medcin']?></td>
                              <td><?php echo  $operation['nom_specialite']?></td>
                              <td><?php echo $operation['date']?></td>
                              
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
   
     
       <div class="link">
        <a href="http:../demander_hospitalisation.php"> Demande Hospitalisation</a>
        <a href="http:../demander_operation.php">Demande Opération</a>
        </div> 
    </form>


</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>