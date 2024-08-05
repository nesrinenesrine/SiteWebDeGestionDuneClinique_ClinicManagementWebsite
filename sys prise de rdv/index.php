<?php
session_start();
include '../inc/db.php';
$sql_specialite ='SELECT *
FROM specialite';
if (mysqli_query($conn,$sql_specialite))
{
    $result = mysqli_query($conn,$sql_specialite);
    $specialites=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}
if(isset($_POST['specialite']))
{
  $_SESSION['id_specialite']=$_POST['specialite'];
  header("location:specialite.php");
}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="../css/style-home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <title>CLINIQUE DE CONFORT</title>
</head>
<body>
  <form action="index.php" method="post">
    <nav>
        
            <div class="logo">
               <img src="../img/CLINIQUE DE CONFORT.svg" alt="">
            </div>
           
              <div class="nav-list liste" id="nav-menu">
                 <i class="uil uil-multiply" class="nav_close" id="close-menu"></i>
                 <ul class="nav_menu" >
                   <li class="nav_item"><a href="#" class="nav-link">Accueil</a></li>
                   <li><a href="#">specialite</a>
                     <div class="categories">
                         <ul>
                            <?php foreach($specialites as $specialite):?>
                              <li ><button type="submit" name="specialite" 
                              value="<?php echo $specialite['id_specialite']?>"  class="b"> <?php echo $specialite['nom_specialite'] ;?> </button></li><br>
                             <?php endforeach;?>
                         </ul>   
                     </div>  
                  </li>
                   
                   <li class="nav_item"><a href="#" class="nav-link">À propre</a></li>
                   <li class="nav_item"><a href="#" class="nav-link">Contact</a></li>
                   <li class="nav_item"><button><a href="./login.php" class="nav-link" id="a-button">Se connecter</a></button></li>
                   <li class="nav_item"><button><a href="./cree_compte.php" class="nav-link" id="a-button">Créer un compte</a></button></li>
                 </ul>

             </div>
              
             <i class="uil uil-bars" id="open-menu"></i> 
  
    </nav>
     <header class="slider">
        <div class="slides">
          <input type="radio" name="radio-btn" id="radio1">
          <input type="radio" name="radio-btn" id="radio2">
          <input type="radio" name="radio-btn" id="radio3">
          <input type="radio" name="radio-btn" id="radio4">
          <input type="radio" name="radio-btn" id="radio5">
          <div class="slide first">
             <img src="../img/img-slide1.jpg" alt="">
          </div>
          <div class="slide">
            <img src="../img/img-slide2.jpg" alt="">
          </div>
          <div class="slide ">
            <img src="../img/img-slide3.jpg" alt="">
          </div>
          <div class="slide">
             <img src="../img/img-slide4.jpg" alt="">
          </div>
          <div class="slide ">
             <img src="../img/img-slide5.jpg" alt="">
          </div>

          <div class="auto">
           <div class="auto-btn1"></div>
           <div class="auto-btn2"></div>
           <div class="auto-btn3"></div>
           <div class="auto-btn4"></div>
           <div class="auto-btn5"></div>
         </div>
         <div class="manual">
           <label for="radio1" class="manual-btn"></label>
           <label for="radio2" class="manual-btn"></label>
           <label for="radio3" class="manual-btn"></label>
           <label for="radio4" class="manual-btn"></label>
           <label for="radio5" class="manual-btn"></label>
         </div>



       </div>
        
         
    </header>
    <div class="signin">
      <div class="left">
      <h2>Pour les patients</h2>
        <ul>
          <li>Mettre à jour votre profil</li>
          <li>prendre vos rendez-vous</li>
          <li>voir les fichier médical de  vos patients et bien plus encore...</li>
        </ul>
          <button><a href="creer-comptemed.php">creer compte</a></button>
      </div>
      <div class="right">
          <img src="../img/signin1.jpg" alt="">
      </div>
    </div>
    
  
    <div class="operation">
      
    </div>
    <footer>
        <div class="footer-list" id="footer">
            <h3>CLINIQUE DE CONFORT</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. 
                Voluptatibus repudiandae maxime quis eligendi distinctio.</p>
            <ul class="social">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>

            </ul>
        </div>
        <div class="footer-bottom">
            <p>copyright &copy ; 2022 LHA STORE designed <span>KNN</span></p>
        </div>
    </footer>



<script type="text/javascript" src="../js/main.js"></script>

</form>
</body>
</html>

