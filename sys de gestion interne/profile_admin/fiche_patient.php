<?php 
session_start();
include '../../inc/db.php';
$id_patient= $_SESSION['id_patient'];

$sql_rdv="SELECT * FROM `rdv` 
JOIN medcin ON medcin.id_medcin=rdv.id_medcin 
JOIN time ON rdv.id_time = time.id_time 
JOIN specialite ON specialite.id_specialite = medcin.id_specialite 
WHERE rdv.id_patient='$id_patient'";
if (mysqli_query($conn,$sql_rdv))
{
    $result = mysqli_query($conn,$sql_rdv);
    $rdvs=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

$sql_hospi="SELECT * FROM `hospitalisation` 
JOIN service ON hospitalisation.id_service = service.id_service 
WHERE hospitalisation.id_patient ='$id_patient';";
if (mysqli_query($conn,$sql_hospi))
{
    $result = mysqli_query($conn,$sql_hospi);
    $hospitalisations=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

$sql_operation="SELECT * FROM `medcin` 
JOIN operation ON (operation.id_medcin= medcin.id_medcin and operation.id_patient ='$id_patient') 
JOIN specialite ON specialite.id_specialite = medcin.id_specialite;";
if (mysqli_query($conn,$sql_operation))
{
    $result = mysqli_query($conn,$sql_operation);
    $operations=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}


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
       <a href="./profil_admin.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
<div class="fiche">
    <form action="fiche_patient.php" method="post">
        
        <h3>Les Rendez-Vous</h3>
        <table>
                       <thead>
                           <tr>
                               <td>Nom Prénom de Médecin </td>
                               <td>Date de rendez_vous</td>
                               <td>Temps de rendez_vous</td>
                               <td>le Spécialités</td>
                               
                               

                           </tr>
                       </thead>
                       <tbody>
                       <?php  foreach($rdvs as $rdv) :?>
                            <tr>
                            <td><?php echo  $rdv['nom_medcin'] . $rdv['prenom_medcin']?></td>
                            <td><?php echo  $rdv['date'] ?></td>
                            <td><?php echo  $rdv['time'] ?></td>
                            <td><?php echo  $rdv['nom_specialite']  ?></td>
                              
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
                               <td>Id lit</td>
                               <td>Id chambre</td>
                               <td>le Service</td>
                              

                           </tr>
                       </thead>
                       <tbody>
                       <?php foreach ($hospitalisations as $hospi):?>
                            <tr>
                              
                              <td><?php echo  $hospi['date_entre']  ?></td>
                              <td><?php echo $hospi['date_sortie'] ?></td>
                              <td><?php echo $hospi['id_lit'] ?></td>
                              <td><?php echo $hospi['id_chambre'] ?></td>
                              <td><?php echo $hospi['nom_service']?></td>
                              
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
                               <td>Date d'Opération</td>
                               <td>Heure d'Opération</td>

                           </tr>
                       </thead>
                       <tbody>
                       <?php foreach($operations as $operation):?>
                            <tr>
                              
                              <td><?php echo $operation['nom_medcin'] . $operation['prenom_medcin']?></td>
                              <td><?php echo $operation['nom_specialite']?></td>
                              <td><?php echo $operation['date'] ?></td>
                              <td><?php echo $operation['heur'] ?></td>
                              
                              
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
        
    </form>
</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>