<?php 
session_start();
include '../inc/db.php';
include '../inc/form.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-creercompte.css">
    <title>Document</title>
</head>
<body>
<div class="box2">
      
    
      <div class = "creer-compte">
              <h1>Créer Compte</h1>
              
      <form action="cree_compte.php" method="POST">
         <div class="nom-prenom">
             <div class="form-input">
              
              <input class ="form__input" type="text"      name="nom"               id="nom"              
              placeholder=" "   value="<?php if (isset($_POST['submit'])){ echo  $nom ;}?>"> <br>
              <label class ="form__label" for="nom">Nom:</label>
              <span><?php echo $err_nom ;?> </span> <br>
             </div> 
             <div class="form-input">
              
              <input class ="form__input" type="text"      name="prenom"            id="prenom"    
              placeholder=" "  value="<?php if (isset($_POST['submit'])){ echo  $prenom ;}?>" > <br>
              <label for="prenom" class ="form__label">Prénom:</label>
              <span><?php echo $err_prenom ;?> </span><br>
              </div> 
          </div>
            <div class="form-input">
              
              <input class ="form__input" type="text"      name="username"          id="username"  
              placeholder=" "  value="<?php if (isset($_POST['submit'])){ echo  $username;} ?>"> <br>
              <label class ="form__label" for="username">Nom d'utilisatuer:</label>
              <span><?php echo $err_username ;?> </span><br>
              </div>  
          <div class="form-radio">
              <label for="sexe">Sexe:</label>
              <label for="">
              <input type="radio" name="sexe" id="famele"  
              <?php if (isset($_POST["sexe"]) && $_POST["sexe"]=="femele") echo "checked";?> value="femele" >
              <span></span>
              femele</label>
              <label for="">
              <input type="radio" name="sexe" id="male"  
              <?php if (isset($_POST["sexe"]) && $_POST["sexe"]=="male") echo "checked";?> value="male">
              <span></span>
              male</label>
              <label for="">
              <input type="radio" name="sexe" id="autre"
              <?php if (isset($_POST["sexe"]) && $_POST["sexe"]=="autre") echo "checked";?> value="autre"> 
              <span></span>
              autre</label> <br>
          </div>
              <span><?php echo $err_sexe ;?> </span><br>
         
          <div class="form-date">
           
              <label for="age"> Date de naissance</label>
              <input type="date"      name="age"         id="age"        
              placeholder=" "       value="<?php echo  $date ;?>"> <br>
              <span><?php echo $err_date;?> </span><br>
          
          </div>
          <div class="form-input">
              <input class ="form__input" type="email"     name="email"       id="email"      
              placeholder=" "        value="<?php if (isset($_POST['submit'])){echo $email ;}?>"><br>
              <label class ="form__label" for="email">Email:</label>
              <span><?php echo $err_email ;?> </span><br>
          </div>
      <div class="nom-prenom">
           <div class="form-input">
             
              <input class ="form__input" type="tel"       name="telephone"   id="telephone"  
              placeholder=" "    value="<?php if (isset($_POST['submit'])){echo $telephone ;}?>"><br>
              <label class ="form__label" for="tel">Téléphone:</label>
              <span><?php echo $err_tel ;?> </span><br>
          </div>
          <div class="form-input">
             
              <input class ="form__input" type="text"      name="adress"      id="adress"     
              placeholder=" "    value="<?php if (isset($_POST['submit'])){echo $adress;} ?>"><br>
              <label class ="form__label" for="adress">Adresse:</label>
              <span><?php echo $err_adress ;?> </span><br>
          </div>
      </div>
      <div class="nom-prenom">
          <div class="form-input">
              
              <input class ="form__input" type="text"      name="ville"       id="ville"      
              placeholder=" "     value="<?php if (isset($_POST['submit'])){echo $ville ;}?>"> <br>
              <label class ="form__label" for="ville">Ville:</label>
              <span><?php echo $err_ville ;?> </span><br>
          </div>   
          <div class="form-input">
              
              <input class ="form__input" type="text"      name="emploi"     id="emploi"     
              placeholder=" "     value="<?php if (isset($_POST['submit'])){echo $emploi ;}?>"><br>
              <label class ="form__label" for="emploi">Emploi:</label>
              <span><?php echo $err_emploi;?> </span><br>
          </div>
      </div>
      <div class="nom-prenom">
          <div class="form-input">
              
              <input class ="form__input" type="password"  name="password1"  id="password1"  
              placeholder=" "  value="<?php if(isset($_POST['submit'])){echo  $password1;}?>"> 
              <label class ="form__label" for="password1">Mot de passe:</label><br>
          </div>   
          <div class="form-input">
              <input class ="form__input" type="password"  name="password2"  id="password2"  
              placeholder=" "  value="<?php if(isset($_POST['submit'])){ echo $password2;}?>"> 
              <label class ="form__label" for="password2">Confarmation :</label>
              <span><?php echo $err_pass ;?> </span><br>
          </div> 
      </div>    
      <div class="secon">
            <p class="p-creer">Avez-vous déjà un compte  <a href="login.php">se connecter</a></p>
           
        </div>
        <div class="seconbat">
              <button  type="submit" name="submit">Creer compte</button>
        </div>
         </form>
       </div>
            <div class="img"><img src="../img/logo-of-profile.svg" alt=""></div>
      </div>
      
</body>
</html>