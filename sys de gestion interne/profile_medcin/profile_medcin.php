<?php
session_start();
if (!isset($_SESSION['userId']) )
{
    header("location:login.php");
    exit();
}
else{
    
    $id=$_SESSION['userId'];
    
    include '../../inc/db.php';
    include './operation.php';
    include './patient.php';
    include './modif_info_medecin.php';
    include './rendez_vous.php';
    $sql="SELECT * FROM `medcin` JOIN specialite on specialite.id_specialite=medcin.id_specialite WHERE medcin.id_medcin='$id';";
    if (mysqli_query($conn,$sql))
    {
        $result = mysqli_query($conn,$sql);
        $medecin2=mysqli_fetch_all($result, MYSQLI_ASSOC);
       
        $nom=$medecin2[0]['nom_medcin'];
        $username=$medecin2[0]['user_name_medcin'];
        $prenom=$medecin2[0]['prenom_medcin'];
        $sep=$medecin2[0]['nom_specialite'];
        $prenom_medcin=$medecin2[0]['prenom_medcin'];
        $role=$medecin2[0]['role'];
    }else 
    { 
        echo ("error" . mysqli_error($conn) );
    }
}





?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-profile.css">
    <link rel="stylesheet" href="../../css/style-patmed.css">
    <title>profile medecin</title>
</head>

<body>
<div class="contaire">
     <div class="nav">
        <ul class="tabs">
           <li>
               <a href="#">
                  
                   
               </a>
          </li>
           <li class="tab">
               <a data-switcher data-tab="1">
                   <span class="icon"><ion-icon name="person-circle-outline"></ion-icon></span>
                   <span class="title">Mes rendez-vous</span>
               </a>
           </li>
           <li class="tab">
               <a data-switcher data-tab="2">
                   <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                   <span class="title">Mes patients</span>
               </a>
           </li>
           <li class="tab">
               <a data-switcher data-tab="3">
                   <span class="icon"><ion-icon name="pulse-outline"></ion-icon></span>
                   <span class="title">Les operation</span>
               </a>
            </li>
           <li class="tab">
               <a data-switcher data-tab="4">
                   <span class="icon"><ion-icon name="pulse-outline"></ion-icon></span>
                   <span class="title">Modifier mes informations</span>
               </a>
            </li>
            <?php if($role=="admin"):?>
            <!-- admin -->
                <li class="tab">
                <a href="../profile_admin/profil_admin.php">
                    <span class="icon"><ion-icon name="pulse-outline"></ion-icon></span>
                    <span class="title">espace admin</span>
               
                </a>
            <?php endif;?>

            <?php if($role=="chef de service"):?>
            <!-- chef de chef  -->
                <li class="tab">
                <a href="../profile chef de service/profile-chef.php">
                    <span class="icon"><ion-icon name="pulse-outline"></ion-icon></span>
                    <span class="title">espace de chef de service </span>
                    </a>
                </li>
            <?php endif;?>

           <li >
               <a href="../logout.php" >
                   <span class="icon"><ion-icon name="log-in-outline"></ion-icon></span>
                   <span class="title">Sortie</span>
               </a>
               
            </li>
        </ul>
       </div>

 <div class="mains">
           <div class="topbar">
               <div class="toggle">
                 <ion-icon name="menu-outline"></ion-icon>
               </div>
               <div class="user">
               <ion-icon name="home-outline"><a href="../index.php"></a></ion-icon>
               </div>

           </div>
               
         <div class="mod-info main is-active" data-main="1">
         <div class="boxs">
            <div class="welcome-box">
                 <h2>Bienvenus <span class="username"><?php echo $username?></span> à le Clinique de Confort </h3>
            </div>
              <div class="box-info">
                  <h3>Mes informations</h3>
                   
                  <h4>Nom d'utilisateur :<span><?php echo $username?></span></h4>
                  <h4>Nom :<span><?php echo $nom ?></span></h4>
                  <h4>Prénom  :<span><?php echo $prenom?></span></h4>
                  <h4>Spécialité  :<span><?php echo $sep?></span></h4>
               </div>
               </div>   
           <form class="tableau-pat" action="rendez_vous.php" method="post">
           <div class="head">
                  <h3>Mes Rendez-Vous</h3>
              </div>
           <table  class="tab-rendez">
                       <thead>
                           <tr>
                               <td>Prénom patient</td>
                               <td>Nom Patient</td>
                               <td>age</td>
                               <td>sexe</td>
                               <td>Email</td>
                              
                               <td>Date de rendez_vous</td>
                               <td>Heure de rendez_vous</td>
                               

                           </tr>
                       </thead>
                       <tbody>
                       <?php  foreach($rdvs as $rdv) :?>
                            <tr>
                              <td ><?php echo  $rdv['prenom'] ?></td>
                              <td><?php echo  $rdv['nom'] ?></td>
                              <td><?php echo  $rdv['age'] ?></td>
                              <td><?php echo  $rdv['sexe'] ?></td>
                              <td><?php echo  $rdv['email'] ?></td>
                              
                              <td><?php echo  $rdv['date'] ?></td>
                              <td><?php echo  $rdv['time'] ?></td>
                              
                              
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
               </form>
      
           
          
        </div>
                

          

           <div class="patient main" data-main="2">
              
           
               
               <form class="tableau-pat" action="patient.php" method="post">
               <div class="head">
                  <h3>Mes patients</h3>
              </div>
                  <table  class="tab-rendez">
                       <thead>
                           <tr>
                               
                               <td>Nom</td>
                               <td>Prénom</td>
                               <td>Nom d'utilisateur</td>
                               <td>Email</td>
                               <td>age</td>
                               <td>sexe</td>
                               <td>fichier</td>
                               

                           </tr>
                       </thead>
                       <tbody>
                       <?php foreach($sql_patients as $sql_patient) :?>
                           <tr>
                              
                              <td><?php echo  $sql_patient['nom'] ?></td>
                              <td><?php echo  $sql_patient['prenom'] ?></td>
                              <td><?php echo  $sql_patient['user_name'] ?></td>
                              <td><?php echo  $sql_patient['email'] ?></td>
                              <td><?php echo  $sql_patient['age'] ?></td>
                              <td><?php echo  $sql_patient['sexe'] ?></td>
                              
                              <td><button type ="submit" name="fiche_patient"  value="<?php echo $sql_patient['id_patient']; ?>"> fiche patient</button></td>
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
               </form>

   
                   
        </div>
        <div class="les operation main" data-main="3">
        <form class="tableau-pat" action="patient.php" method="post">
        <div class="head">
                  <h3>Mes operation</h3>
              </div>
                  <table  class="tab-op">
                       <thead>
                           <tr>
                               
                               <td>Nom patient</td>
                               <td>Prénom patient</td>
                               <td>numero de bloc</td>
                               <td>date de operation</td>
                               <td>heure de debut</td>
                               <td>heure de fin</td>
                               
                               

                           </tr>
                       </thead>
                       <tbody>
                       <?php  foreach($operations as $operation):?>
                           <tr>
                              
                              <td><?php echo  $operation['nom'] ?></td>
                              <td><?php echo  $operation['prenom'] ?></td>
                              <td><?php echo  $operation['id_bloq'] ?></td>
                              <td><?php echo  $operation['date'] ?></td>
                              <td><?php echo  $operation['heur'] ?></td>
                              <td><?php echo  $operation['heur_fin'] ?></td>
                              
                            
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
            </form>


             
        </div>
 <div class="rendez-vous main" data-main="4">
        <div class = "box box-mod"> 
                
                <h2>Modification</h2>
             
                <form action="./modif_info_medecin.php" method="POST" >
              <div class="nom-prenom">
                 <div class="form-input">
                  <?php if(!isset($_POST['nom'])){$nom=$medecin['nom_medcin'];} ?>
                    
                    <input class="form__input" type="text"      name="nom"               id="nom"              
                    placeholder=" "  value="<?php { echo  $nom ;}?>"> <br>
                    <label class ="form__label" for="nom">Nom:</label>
                    <span><?php echo $err_nom ;?> </span> <br>
                 </div>
                
                 <div class="form-input">
                 <?php if(!isset($_POST['prenom'])){$prenom=$medecin['prenom_medcin'];} ?>
                    
                    <input class="form__input" type="text"      name="prenom"            id="prenom"    
                    placeholder=" "  value="<?php { echo  $prenom ;}?>" > <br>
                    <label for="prenom" class ="form__label">Prénom:</label>
                    <span><?php echo $err_prenom ;?> </span><br>
                  </div>

              </div>
                  <div class="form-input">
                  <?php if(!isset($_POST['username'])){$username=$medecin['user_name_medcin'];} ?>
                  
                  <input class="form__input" type="text"      name="username"          id="username"  
                  placeholder=" "  value="<?php { echo  $username;} ?>"> <br>
                  <label class ="form__label" for="username">Nom d'utilisatuer:</label>
                  <span><?php echo $err_username ;?> </span><br>

                  </div>
                  <div class="form-input">
                  <?php if(!isset($_POST['email'])) {$email=$medecin['email_medcin'];} ?>
                  
                  <input class="form__input" type="email"     name="email"       id="email"      
                  placeholder=" "        value="<?php {echo $email ;}?>"><br>
                  <label class ="form__label" for="email">Email:</label>
                  <span><?php echo $err_email ;?></span><br>
                  </div>
               
                  <div class="form-input">
                  <?php if(!isset($_POST['telephone'])){ $telephone=$medecin['telephone_medcin'];} ?>
                 
                  <input class="form__input" type="tel"       name="telephone"   id="telephone"  
                  placeholder=" "    value="<?php {echo $telephone ;}?>"><br>
                  <label class ="form__label" for="tel">Téléphone:</label>
                  <span><?php echo $err_tel ;?></span><br>
                  </div>

                  <button type="submit" name="submit">confirmer</button>
              </form>
           </div>
       </div>
      
    </div>

    
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>











    <script src="../../js/main-profile.js"></script>
</body>

</html>