<?php 
$err_nom="";
$err_prenom="";
$err_username="";
$err_tel="";
$err_email="";
$err_pass="";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="cree_compte_medcin.php" method="POST" >

        <label for="nom">Nom:</label>
        <input type="text"      name="nom"               id="nom"              
        placeholder="saisissez votre nom"  value="<?php //if (isset($_POST['submit'])){ echo  $nom ;}?>"> <br>
        <span><?php echo $err_nom ;?> </span> <br>
        
        <label for="prenom">Prénom:</label>
        <input type="text"      name="prenom"            id="prenom"    
        placeholder="saisissez votre prenom"  value="<?php //if (isset($_POST['submit'])){ echo  $prenom ;}?>" > <br>
        <span><?php echo $err_prenom ;?> </span><br>

        <label for="username">Nom d'utilisatuer:</label>
        <input type="text"      name="username"          id="username"  
        placeholder="saisissez votre nom d'utilisateur"  value="<?php //if (isset($_POST['submit'])){ echo  $username;} ?>"> <br>
        <span><?php echo $err_username ;?> </span><br>

        <label for="specialite">specialite:</label> <br> <br>
        <select name="specialite" id="specialite"  onchange="javascript:submit(this);" class ="zone_de_choix">
            <option></option>
            <?php  //foreach($specialites as $specialite):?>
                <option value="<?php //echo $specialite['id_specialite'];?>" <?php //if(isset($_POST['specialite'])){if($_POST['specialite']==$specialite['id_specialite']){echo "selected";}} ?> class="option"> 
                    <?php //echo  $specialite['nom_specialite']; ?>
                </option>
            <?php //endforeach;?>   
        </select> <br>


        <label for="tel">Téléphone:</label>
        <input type="tel"       name="telephone"   id="telephone"  
        placeholder="saisissez votre téléphone"    value="<?php //if (isset($_POST['submit'])){echo $telephone ;}?>"><br>
        <span><?php echo $err_tel ;?> </span><br>

        <label for="email">Email:</label>
        <input type="email"     name="email"       id="email"      
        placeholder="saisissez votre email"        value="<?php //if (isset($_POST['submit'])){echo $email ;}?>"><br>
        <span><?php echo $err_email ;?> </span><br>

        <label for="password1">Mot de passe:</label>
        <input type="password"  name="password1"  id="password1"  
        placeholder="saisissez un mot de passe"  value="<?php //if(isset($_POST['submit'])){echo  $password1;}?>"> <br>
        
        <input type="password"  name="password2"  id="password2"  
        placeholder="confirmer le mot de passe"  value="<?php //if(isset($_POST['submit'])){ echo $password2;}?>"> 
        <span><?php echo $err_pass ;?> </span><br>

        <input type="checkbox" name="option[]" id="dimanche" value="Sunday"> 
        <label for="dimanche"> Dimanche</label> <br>
        <input type="checkbox" name="option[]" id="lundi"   value="Monday"> 
        <label for="lundi"> Lundi</label> <br>
        <input type="checkbox" name="option[]" id="mardi"    value="Tuesday"> 
        <label for="mardi"> Mardi</label> <br>
        <input type="checkbox" name="option[]" id="mercredi"  value="wednesday"> 
        <label for="mercredi"> Mercredi</label> <br>
        <input type="checkbox" name="option[]" id="jeudi"   value="Thursday"> 
        <label for="jeudi"> Jeudi</label> <br>

        <button type="submit" name="submit">confirmer</button>
    </form>
</body>
</html>