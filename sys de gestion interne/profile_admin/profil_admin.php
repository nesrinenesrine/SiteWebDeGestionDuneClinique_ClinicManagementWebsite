<?php
session_start();
include './les_nv_medcin.php';
include './patient.php' ;

include './les_demmande_operation.php' ;
include './ajouter_specialite.php';
include './medcin.php';
include './operation.php';
include './dashboard/dashboard.php' ;

$count="";
$sql_demmande="SELECT * FROM demmande_operataion WHERE demmande_operataion.etat=0 ";
if (mysqli_query($conn,$sql_demmande))
{
    $result = mysqli_query($conn,$sql_demmande);
    $count=mysqli_num_rows($result);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

$sql_nv_medecin="SELECT * FROM `nv_medcin`";
if (mysqli_query($conn,$sql_demmande))
{
    $result = mysqli_query($conn,$sql_nv_medecin);
    $count_med=mysqli_num_rows($result);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

if(isset($_POST['suprimer']))
{
    $_SESSION['id_sep'] = $_POST['suprimer'] ;
    echo $_POST['suprimer'];
    header("location:../specialite/suprimer.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-profile.css">
    <link rel="stylesheet" href="./dashboard/style-dash.css">
    
    <title>profile admin</title>
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
                   <span class="icon"><ion-icon name="bar-chart-outline"></ion-icon></span>
                   <span class="title">Tableau de bord</span>
               </a>
           </li>
           <li class="tab">
               <a data-switcher data-tab="2">
                   <span class="icon"><ion-icon name="pulse-outline"></ion-icon></span>
                   <span class="title">Les patients</span>
               </a>
           </li>
           <li class="tab">
               <a data-switcher data-tab="3">
                   <span class="icon"><ion-icon name="people-circle-outline"></ion-icon></span>
                   <span class="title">Les médecins</span>
               </a>
            </li>
           <li class="tab">
               <a data-switcher data-tab="4">
                    <?php if($count<>0):?>
                      <span class="notf"><p> <?php echo $count ;?></p> </span>
                    <?php endif;?>
                   <span class="icon"><ion-icon name="add-circle-outline"></ion-icon></ion-icon></span>
                   <span class="title">Les demandes opérations </span>
                   
               </a>

            </li>
           
           <li >
               <a data-switcher data-tab="5" >
               <span class="icon"><ion-icon name="bandage-outline"></ion-icon></span>
                   <span class="title">Les opérations </span>
               </a>
            <li>
            <li >
               <a data-switcher data-tab="6" >
               <span class="icon"><ion-icon name="medkit-outline"></ion-icon></span>
                   <span class="title">Les specialite </span>
               </a>
               <li class="tab">
               <a data-switcher data-tab="7" >
                    <?php if($count_med<>0):?>
                      <span class="notf"><p><?php echo $count_med;?></p> </span>
                    <?php endif;?>
                   <span class="icon"><ion-icon name="person-add-outline"></ion-icon></span>
                   <span class="title"> Les nouveau médecins</span>
                  
               </a>
            </li>
            <li class="tab">
                <a href="../profile_medcin/profile_medcin.php">
                    <span class="icon"><ion-icon name="pulse-outline"></ion-icon></span>
                    <span class="title">espace médecin</span>
               
                </a>
            </li>
            <li>
               <a href="../logout.php" >
                   <span class="icon"><ion-icon name="log-in-outline"></ion-icon></span>
                   <span class="title">Sortir </span>
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
               
  <div class="dashboard main is-active" data-main="1">
                    <div class="dash-list">
                        <ul class="lists">
                            <li class="list is-show">
                                <a data-dashboard data-dash="1">
                                    <div>
                                        <div class="numbres"><?php echo $numbreP ?></div>
                                        <div class="cardname">les patients</div>
                                    </div>
                                    <div class="iconbx">
                                    <ion-icon name="accessibility-outline"></ion-icon>
                                    </div>

                                </a>
                            </li>
                            <li  class="list">
                                <a data-dashboard data-dash="2">
                                    <div>
                                        <div class="numbres"><?php echo $numbreMed ?></div>
                                        <div class="cardname">les médecin</div>
                                    </div>
                                    <div class="iconbx">
                                    <ion-icon name="accessibility-outline"></ion-icon>
                                    </div>
                            
                                </a>
                                </li>
                            <li class="list">
                                <a data-dashboard data-dash="3">
                                        <div>
                                            <div class="numbres"><?php echo $numbreop ?></div>
                                            <div class="cardname">les opérations </div>
                                        </div>
                                        <div class="iconbx">
                                        <ion-icon name="bandage-outline"></ion-icon>
                                        </div>
                                </a>
                            </li>
                            <li class="list">
                                <a data-dashboard data-dash="4">
                                        <div>
                                            <div class="numbres"><?php echo $numbrehosp ?></div>
                                            <div class="cardname">les hospitalisation</div>
                                        </div>
                                        <div class="iconbx">
                                        <ion-icon name="bed-outline"></ion-icon>
                                        </div>
                                </a>
                            </li>
                        </ul>
                        </div>
                    <div class="charts">
                        <div class="charts-pat chart is-show " data-charts="1">
                              <div class="grid">
                                 <div class="id-1 line">
                                     <canvas id="myChart1"></canvas>
                                 </div>
                                 <div class="id-1 dounaght">
                                     <canvas id="myChart"></canvas>
                                 </div>
                                
                                 <div class="id-1 bar" >
                                     <canvas id="myChart2"></canvas>
                                 </div>
                                 <div class="id-1 pie">
                                     <canvas id="myChart3"></canvas>
                                 </div>
                     </div>
                        </div>
                        <div class="charts-med chart " data-charts="2">
                        <div class="id-1 line">
                                     <canvas id="myChart4"></canvas>
                                 </div>
                                 <div class="id-1 dounaght">
                                     <canvas id="myChart5"></canvas>
                                 </div>
                                
                                 <div class="id-1 bar" >
                                     <canvas id="myChart6"></canvas>
                                 </div>
                        </div>
                        <div class="charts-op chart " data-charts="3">
                                <h3>ace</h3>
                        </div>
                        <div class="charts-op chart " data-charts="4">
                                <h3>sgsfbfdb</h3>
                        </div>
                    </div>
                                
                   
                            
              
       
  </div>  
          

    <div class="patient main" data-main="2" id="patient">
         
               <div class="listeheader">
                   <h3>les Patients</h3>
                   
               </div>
               
               <form  class="tab-med" action="./patient.php" method="post">
                   <table>
                       <thead>
                           <tr>
                               <td>id_patient</td>
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
                           <?php foreach($patients as $patient):?>
                           <tr>
                              <td class ="id"><?php echo  $patient['id_patient'] ?></td>
                              <td><?php echo  $patient['nom'] ?></td>
                              <td><?php echo  $patient['prenom'] ?></td>
                              <td><?php echo  $patient['user_name'] ?></td>
                              <td><?php echo  $patient['email'] ?></td>
                              <td><?php echo  $patient['age'] ?></td>
                              <td><?php echo  $patient['sexe'] ?></td>
                              
                              <td><button class ="btn" type="submit"  name="fiche_patient" value="<?php  echo  $patient['id_patient'] ;?>">Fichier  Patient</button></td>
                                
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
               </form>
          
    </div>
           <div class="Medecin main" data-main="3">
               
           <div class="head"><h3>Les médecins </h3></div>
               
               <form class="tab-med" action="./medcin.php" method="post">
                   <table>
                       <thead>
                           <tr>
                               
                               <td>Les Spécialités</td>
                               <td>Nom  médecin</td>
                               <td>Prénom  médecin</td>
                               <td>Nom d'utilisateur</td>
                               <td>Email</td>
                               <td>fiche médecin</td>
                               <td>fiche médecin</td>
                               

                           </tr>
                       </thead>
                       <tbody>
                           
                         <?php foreach($med_seps as $med_sep):?>
                           <tr>
                           <td><?php echo $med_sep['nom_specialite'] ?></td>
                              <td><?php echo $med_sep['nom_medcin'] ?></td>
                              <td><?php echo  $med_sep['prenom_medcin'] ?></td>
                              <td><?php echo $med_sep['user_name_medcin'] ?></td>
                              <td><?php echo  $med_sep['email_medcin'] ?></td>
                              <td><button class ="btn" type="submit"  name="chef_service" value="<?php  echo  $med_sep['id_medcin'] ;?>">Chef de service</button></td>
                              <td><button class ="btn" type="submit"  name="submit" value="<?php  echo  $med_sep['id_medcin'] ;?>">fiche médecin</button></td>
                        <?php endforeach?>
                           </tr>
                           
                       </tbody>
                      
                   </table>
               </form>
             
           </div>
    <div class="dem-operation main" data-main="4">

        <form action="./les_demmande_operation.php" method="post">
            <div class="head"><h3>Les demandes opérations</h3></div>
                   <table class="tab-op">
                       <thead>
                           <tr>
                               <td>Id médecin</td>
                               <td>Prénom Nom</td>
                               <td>Id patient</td>
                               <td>Prénom Nom</td>
                               <td>Description</td>
                               
                               <td>Organiser</td>
                               

                           </tr>
                       </thead>
                       <tbody>
                       <?php foreach($demmandes as $demmande) :?>
                           <tr>
                              
                              <td class ="id"><?php echo  $demmande['id_medcin'] ?></td>
                              <td><?php echo  $demmande['prenom_medcin'] . $demmande['nom_medcin'] ?></td>
                              <td class ="id"><?php echo  $demmande['id_patient']  ?></td>
                              <td><?php echo  $demmande['prenom'] . $demmande['nom'] ?></td>
                              <td><?php echo $demmande['description']  ?></td>
                              <td><button type="submit"  name="organiser_operation"  value="<?php echo $demmande['id_demmande']; ?>">organiser opérations</button></td>
                              
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
               </form>
             
            
                
                  
                   
             
           </div>
           <div class="operation main" data-main="5">
           <form class="tableau-pat" action="./operation.php" method="post">
              <div class="head"><h3>Les opérations</h3></div>
              <table class="tab-op">
                       <thead>
                           <tr>
                               <td>Prénom Nom médecin</td>
                               <td>Prénom Nom patient</td>
                               <td>numéro de bloc</td>
                               <td>Date opération</td>
                               <td>Heure de debut opération</td>
                               <td>heure de fin opération</td>
                               <td>Modifier</td>
                               <td>Suprimer</td>
                               

                           </tr>
                       </thead>
                       <tbody>
                       <?php foreach($operations as $operation):?>
                           <tr>
                              
                              <td ><?php echo  $operation['prenom_medcin'] .$operation['nom_medcin']?></td>
                              <td><?php echo $operation['prenom'] . $operation['nom']  ?></td>
                              <td ><?php echo  $operation['id_bloq']  ?></td>
                              <td><?php echo  $operation['date'] ?></td>
                              <td><?php echo $operation['heur']  ?></td>
                              <td><?php echo $operation['heur_fin']  ?></td>
                              <td><button type="submit"  name="modifie"  value="<?php  echo $operation['id_operation'] ;?>">modifie l'operation</button></td>
                              <td><button type="submit"  name="suprimer" value="<?php  echo $operation['id_operation'] ;?>">supprimer l'operation</button></td>
                             
                                
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
               
               </form>
           </div>
             
         <div class="password main" data-main="6">
         <form class="tableau-pat" action="profil_admin.php" method="post">
         <div class="ajout"><a href="../specialite/ajouter.php">ajouter une nouvelle specialite</a></div>
         <div class="head">
            <h3>Les Spécialités</h3>
            
        </div>
               <table class="tab-sep">
                       <thead>
                           <tr>
                               <td>Les Spécialités</td>
                               <td>supper  Spécialités</td>
                               
                               

                           </tr>
                       </thead>
                       <tbody>
                       <?php foreach($specialites as $specialite):?>
                           <tr>
                              
                              <td ><?php echo  $specialite['nom_specialite'] ?></td>
                 
                              
                              <td> <button type="submit"  name="suprimer" value="<?php  echo $specialite['id_specialite'] ;?>"> supprimer </button> </td>
                             
                                
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
            </form>
        </div>
    <div class="nv_medecin main" data-main="7">
         
    <div class="head"><h3>Les nouveau mèdecins</h3></div>
               
               <form class="tableau-pat" action="./les_nv_medcin.php" method="post">
                   <table>
                       <thead>
                           <tr>
                               <td>id_nv_med</td>
                               <td>Nom</td>
                               <td>Prénom</td>
                               <td>Nom d'utilisateur</td>
                               <td>Email</td>
                               
                               <td>fichier</td>
                               

                           </tr>
                       </thead>
                       <tbody>
                          <?php foreach($nv_medcins as $nv_medcin) :?>
                           <tr>
                              <td class ="id"><?php echo  $nv_medcin['id'] ?></td>
                              <td><?php echo $nv_medcin['nom'] ?></td>
                              <td><?php echo $nv_medcin['prenom'] ?></td>
                              <td><?php echo  $nv_medcin['username'] ?></td>
                              <td><?php echo  $nv_medcin['email'] ?></td>
                              
                              
                              <td><button data-svt data-butt="1" type="submit" name="affecter_emploi" value="<?php echo $nv_medcin['id'] ?>"> affecter emploi</button></td>
                                
                           </tr>
                           <?php endforeach?>
                       </tbody>
                   </table>
               </form>
         
           
      
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="../../js/main-profile.js"></script>
  <script src="./dashboard/main-dash.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

        const numF =<?php echo json_encode($numbreF) ;  ?> ;
        const numM=<?php echo json_encode($numbreM) ;  ?>;

    

        const date8 =<?php echo json_encode($ag_num) ;  ?> ;
        const label8=<?php echo json_encode($ag_emp) ;  ?>;

        const date7 =<?php echo json_encode($vi_num) ;  ?> ;
        const label7=<?php echo json_encode($vi_emp) ;  ?>;


        //setup block
        const date = {
                    labels: ['famele' , 'male'],
                        datasets : [{
                            label: '# of Votes',
                            data: [numF , numM],
                            backgroundColor: [
                                '#274393',
                                '#010c2b'
                                
                            ],
                            borderColor: [
                                '#274393',
                                '#010c2b'
                                
                            ],
                            borderWidth: 1
                  }]
               };
    const date9 =<?php echo json_encode($feed_num) ;  ?> ;
    const label9=<?php echo json_encode($feed_emp) ;  ?>;
    const datefeed = {
        labels: label9,
            datasets : [{
                label: "la réaction des patient a leur exepérience", 
                data: date9,
                backgroundColor: [
                    '#274393',
                    '#adc0f1'
                 ],
                borderColor: [
                    '#274393',
                    '#adc0f1'
                 ],
                borderWidth: 3,
                background: [
                    '#274393',
                ]
        }]
    };
    const config1 ={
        type: 'line',
        data: datefeed,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
        };
        const chart1 = new  Chart(
            document.getElementById('myChart1'),
            config1 
        );
    const dateage = {
        labels: label8,
            datasets : [{
                label: 'Tous les ages dans cette clinique',
                data: date8,
                backgroundColor: [
                    '#274393',
                    '#adc0f1',
                    '#86a5f8',
                    '#6a90fa',
                    '#010c2b'
                    
                ],
                borderColor: [
                    '#274393',
                    '#adc0f1',
                    '#86a5f8',
                    '#6a90fa',
                    '#010c2b'
                    
                ],
                borderWidth: 1
        }]
    };
    const datevi = {
        labels: label7,
            datasets : [{
                label: '# of Votes',
                data: date7,
                backgroundColor: [
                    '#274393',
                    '#010c2b',
                    '#adc0f1',
                    '#86a5f8',
                    '#6a90fa',
                    
                    
                ],
                borderColor: [
                    '#274393',
                    '#010c2b',
                    '#adc0f1',
                    '#86a5f8',
                    '#6a90fa',
                    
                ],
                borderWidth: 1
        }]
    };
        
        //config block
        const config ={
        type: 'doughnut',
        data: date,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
        };
      
        const config2 ={
        type: 'bar',
        data: dateage,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
        };
        const config3 ={
        type: 'pie',
        data: datevi,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
        };
       
        //render block
        const chart = new  Chart(
            document.getElementById('myChart'),
            config 
        );
       
        const chart2 = new  Chart(
            document.getElementById('myChart2'),
            config2 
        );
        const chart3 = new  Chart(
            document.getElementById('myChart3'),
            config3
        );

  

</script>




</body>

</html>