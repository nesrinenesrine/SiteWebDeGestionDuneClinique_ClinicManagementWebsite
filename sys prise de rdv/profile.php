<?php
session_start ();
include '../inc/db.php';
include './modifie_info.php';
include './monrendez-vous.php';
include './recommandation.php';
include './feedback.php';


if (!isset($_SESSION['userId']) ){
    header("location:login.php");
    exit();
}
else
{
    $id=$_SESSION['userId'];
    $sql_patient="SELECT * FROM `patient` WHERE patient.id_patient='$id'";

    if (mysqli_query($conn,$sql_patient))
    {
        $result = mysqli_query($conn,$sql_patient);
        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else 
    { 
        echo ("error" . mysqli_error($conn));
    }

    $nom=$user[0]['nom'];
    $prenom=$user[0]['prenom'];
    $username=$user[0]['user_name'];
    $age=$user[0]['age'];
    $sexe=$user[0]['sexe'];

    $sql_rdv="SELECT * FROM rdv WHERE rdv.id_patient='$id' and rdv.etat_rdv=0";
    if (mysqli_query($conn,$sql_rdv))
    {
        $result = mysqli_query($conn,$sql_rdv);
        $nv_rdv=mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else 
    { 
        echo ("error" . mysqli_error($conn));
    }

    // deleate from consultation
    if(isset($_POST['annuler']))
    {
        $id_rdv=$_POST['annuler'];
        $sql_supp="DELETE FROM `rdv` WHERE rdv.id_rdv='$id_rdv'";
        if (mysqli_query($conn,$sql_supp))
        {
            echo "hello";
            exit();
        }else 
        { 
            echo ("error" . mysqli_error($conn));
        }
    }

    if(isset($_POST['modife']))
    {
        $_SESSION['id_rdv'] = $_POST['modife'];
        header("location:./modif_rdv/specialite_modif.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-profile.css">
    <link rel="stylesheet" href="../css/style-patmed.css">
    <title>profile</title>
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
                   <span class="icon"><ion-icon name="pulse-outline"></ion-icon></span>
                   <span class="title">Mes rendez-vous</span>
               </a>
           </li>
           <li class="tab">
               <a href="./rendez_vous/specialite.php">
                   <span class="icon"><ion-icon name="calendar-clear-outline"></ion-icon></span>
                   <span class="title">Prendre un rendez-vous</span>
               </a>
           </li>
           <li class="tab">
               <a data-switcher data-tab="2">
               <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                   <span class="title">Modifier mes informations</span>
               </a>
            </li>
   
           <li class="tab">
               <a data-switcher data-tab="3">
                   <span class="icon"><ion-icon name="checkmark-outline"></ion-icon></span>
                   <span class="title">Evaluation</span>
               </a>
                
             </li>
           <li >
               <a href="log-out.php" >
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
               <ion-icon name="home-outline"><a href="./index.php"></a></ion-icon>
               </div>

           </div>
        <div class="mon-rendez main is-active" data-main="1">
           <div class="boxs">
            <div class="welcome-box">
                 <h2>Bienvenus <span class="username"><?php echo $username?></span> à le Clinique de Confort </h3>
            </div>
              <div class="box-info">
                  <h3>Mes informations</h3>
                  <h4>Nom d'utilisateur :<span><?php echo $username?></span></h4>
                  <h4>Nom :<span><?php echo $nom ?></span></h4>
                  <h4>Prénom  :<span><?php echo $prenom?></span></h4>
                  <h4>Sexe: <span><?php echo $sexe ?></span></h4>
                  <h4>Age: <span><?php echo $age?></span></h4>
               </div>
         </div>   
               <form class="tableau-pat" action="monrendez-vous.php" method="post">
                   <div class="head"><h3>Mes Rendez-Vous</h3></div>
                   <table class="tab-rendez">
                       <thead>
                           <tr>
                               <td>Nom de médecin</td>
                               <td>Prénom de médecin</td>
                               <td>Email de médecin</td>
                               <td>Date de rendez-vous</td>
                               <td>Heure de rendez-vous</td>
                               <td>modifier rendez-vous</td>
                               <td>annuler rendez-vous</td>
                               

                           </tr>
                       </thead>
                       <tbody>
                       <?php foreach($sql_rendezs as $sql_rendez) :?>
                           <tr>
                              <td ><?php echo  $sql_rendez['nom_medcin'] ?></td>
                              <td><?php echo   $sql_rendez['prenom_medcin'] ?></td>
                              <td><?php echo   $sql_rendez['email_medcin'] ?></td>
                              <td><?php echo   $sql_rendez['date'] ?></td>
                              <td><?php echo   $sql_rendez['time'] ?></td>
                              
                              <td><button type ="submit" name="modif_rendez" value="<?php echo $sql_rendez['id_rdv']; ?>">modifie</button></td>
                              <td><button type ="submit" name="annuler" value="<?php echo $sql_rendez['id_rdv']; ?>">annuler</button></td>
                            </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
               </form>

   
                   
           </div>
           
           <div class="mod-info  main " data-main="2">
             
  
                <div class = "box4 box"> 
                    <h2>Modification</h2>
                 <form action="modifie_info.php"    method="POST">
                    <div class="nom-prenom">
                       <div class="form-input">
                          <?php if(!isset($_POST['nom'])){ $nom =$user[0]['nom'];}?>
                          
                          <input class="form__input" type="text"      name="nom"               id="nom"              
                          placeholder=" "  value="<?php { echo  $nom ;}?>"> <br>
                          <label class ="form__label" for="nom">Nom:</label>
                          <span><?php echo $err_nom ;?> </span> <br>
                       </div>
                      
                       <div class="form-input">
                          <?php if(!isset($_POST['prenom'])){ $nom =$user[0]['prenom'];}?>
                          
                          <input class="form__input" type="text"      name="prenom"            id="prenom"    
                          placeholder=" "  value="<?php { echo  $prenom ;}?>" > <br>
                          <label for="prenom" class ="form__label">Prénom:</label>
                          <span><?php echo $err_prenom ;?> </span><br>
                        </div>

                    </div>
                        <div class="form-input">
                        <?php if(!isset($_POST['username'])){ $nom =$user[0]['user_name'];}?>
                        
                        <input class="form__input" type="text"      name="username"          id="username"  
                        placeholder=" "  value="<?php { echo  $username;} ?>"> <br>
                        <label class ="form__label" for="username">Nom d'utilisatuer:</label>
                        <span><?php echo $err_username ;?> </span><br>

                        </div>
                        <div class="form-input">
                        <?php if(!isset($_POST['email'])){ $nom =$user[0]['email'];}?>
                        
                        <input class="form__input" type="email"     name="email"       id="email"      
                        placeholder=" "        value="<?php {echo $email ;}?>"><br>
                        <label class ="form__label" for="email">Email:</label>
                        <span><?php echo $err_email ;?></span><br>
                        </div>
                      <div class="nom-prenom">
                        <div class="form-input">
                        <?php if(!isset($_POST['telephone'])){ $nom =$user[0]['telephone'];}?>
                       
                        <input class="form__input" type="tel"       name="telephone"   id="telephone"  
                        placeholder=" "    value="<?php {echo $tel ;}?>"><br>
                        <label class ="form__label" for="tel">Téléphone:</label>
                        <span><?php echo $err_tel ;?></span><br>
                        </div>
                        <div class="form-input">
                        <?php if(!isset($_POST['adress'])){ $nom =$user[0]['adresse'];}?>
                       
                        <input class="form__input" type="text"      name="adress"      id="adress"     
                        placeholder=" "    value="<?php {echo $adress;} ?>"><br>
                        <label class ="form__label" for="adress">Adress:</label>
                      </div>
                      </div> 
                      <div class="nom-prenom">
                      <div class="form-input">
                        <?php if(!isset($_POST['ville'])){ $nom =$user[0]['ville'];}?>
                        
                        <input class="form__input" type="text"      name="ville"       id="ville"      
                        placeholder=""     value="<?php {echo $ville ;}?>"> <br>
                        <label class ="form__label" for="ville">Ville:</label>
                        </div>
                        <div class="form-input">
                        <?php if(!isset($_POST['emploi'])){ $nom =$user[0]['emploi'];}?>
                        
                        <input class="form__input" type="text"      name="emploi"     id="emploi"     
                        placeholder=" "     value="<?php {echo $emploi ;}?>"><br>
                        <label class ="form__label" for="ville">emploi:</label>
                        </div>
                      </div>
                       

                        <button type="submit" name="submit">confirmer</button>
                    </form>
                 </div>
             </div>

          

          
     <div class="concact main" data-main="4">
         <div class="recommendation">
           <form action="recommandation.php" method="post">
                 <h3>choisire les symptome </h3>
                 <div class="container">
                   
                    <?php foreach ($symps as $symp):
                        $id_specialite=$symp['id_specialite'];
                         unset($symp['id_reco']);
                        unset($symp['id_specialite']);
                        unset($symp['maladie']);
                        foreach($symp as $s):?>
                        
                             <input type="checkbox" name="option[]" id="xd" value="<?php echo $id_specialite; ?>"> 
                             <label for="xd"><?php echo $s;?></label>
                        
                         <?php endforeach ?>
                         <?php  endforeach;?>
                    
                    </div>
                        <button type="submit" name="symptomes"> confirmer</button>
                    <a href="./rendez_vous/specialite.php"> passer</a>
           
            </form>
         </div>
    </div>
           <div class="password main" data-main="3">
                <div class="reaction">
                    <form action="feedback.php" method="POST">
                            <h2>Réaction</h2>
                        <div class="rea">
                            <div class="rea-radio">
                                <input type="radio" name="react" value="execellen" id="react1">
                                <label for="react1">execellent</label>

                                <input type="radio" name="react" value="trés bie" id="react2">
                                <label for="react2">trés bien</label>

                                <input type="radio" name="react" value="bien" id="react3">
                                <label for="react3">bien</label>

                                <input type="radio" name="react" value="à bien" id="react4">
                                <label for="react4">à bien</label>

                                <input type="radio" name="react" value="mouvais" id="react5">
                                <label for="react5">mauvais</label>

                                <input type="radio" name="react" value="trés mauvais" id="react6">
                                <label for="react6">trés mauvais</label>
                                
                            </div>
                        </div>
                            <button type="submit" name="submit" id="submit_data">submit</button>
                        </form>
                </div>
           </div>
           
        </div>
      
   </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="../js/main-profile.js"></script>

</body>
</html>