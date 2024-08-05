<?php
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
$err_nom="";
$err_prenom="";
$err_username="";
$err_tel="";
$err_email="";
$err_pass="";

if (isset($_POST['submit'])) 
{
    $nom            =htmlspecialchars($_POST['nom']);
    $prenom         =htmlspecialchars($_POST['prenom']);
    $username       =htmlspecialchars($_POST['username']);
    $specialite     =htmlspecialchars($_POST['specialite']);
    $telephone      =htmlspecialchars($_POST['telephone']);
    $email          =htmlspecialchars($_POST['email']);
    $password1      =htmlspecialchars($_POST['password1']);
    $password2      =htmlspecialchars($_POST['password2']);
    $password_code  =password_hash($_POST['password2'],PASSWORD_DEFAULT);

    if(empty($nom)) 
    { 
        $err_nom="vous devez saisir votre nom";
    }elseif (!preg_match("/^[a-zA-Z-' '-']*$/",$nom))
    {
        $err_nom='syntaxe invalide';
    }elseif(empty($prenom))
    {
        $err_prenom= "vous devez saisir votre prénom";
    }elseif (!preg_match("/^[a-zA-Z-' '-']*$/",$prenom))
    {
        $err_prenom = 'syntaxe invalide';
    }elseif(empty($username))
    {
        $err_username='veuillez introduisez votre nom d utilisatuer ';
    }elseif (!preg_match("/^[a-zA-Z1-9-' '-']*$/",$username))
    {
        $err_username='la syntex valable du username est des lettre etles chifre et des espace blac';
    }
    elseif(email_existe($username,$conn))
    {
        $err_username="saisiser un autre nom d'uilisateur :vous pouvez ajouter des chifre ";
    }
    elseif(empty($specialite))
    {
        $err_specialite='veuillez introduisez votre spesialite ';
    }
    elseif(empty($telephone))
    {
        $err_tel="vous devez saisire votre numero de telephone";   
    }elseif(!preg_match("/[0-9]*/",$telephone))
    {
        $err_tel="forma de numerp telephone incorecte";
    }
    elseif(strlen($telephone)<>10)
    {
        $err_tel="FORMA INCORET2";
    }
    elseif(empty($email))
    {
        $err_email="vous devez saisire un email";
    }
    elseif(email_existe($email,$conn))
    {
        $err_email="vous avez deja un compte";
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $err_email="format invalide d'email ";
    }elseif(empty($password1))
    {
        $err_pass='ERROR:veuillez introduisez un mot de passe';
    }
    elseif(strlen($password1) < 8)
    {
        $err_pass="choisire un mot de passe contiet au mion 8 carr";
    }
    elseif(!check_mdp_format($password1))
    {
        $err_pass="le mot de passe doit contenire au moin un carr maj et des chiffre";
    }
    elseif(empty($password2))
    {
        $err_pass='veuillez confirmer votre mot de passe';
    }
    elseif ($password1<>$password2) 
    {
        $err_pass= 'reconfirmer votre mot de passe';
    }
    else
    {
        echo "test2";
        
        $sql = "INSERT  INTO `nv_medcin`(`nom`, `prenom`, `username`,`id_specialite`, `email`, `telephone`, `mot_de_passe`) 
        VALUES ('$nom','$prenom','$username','$specialite','$email','$telephone','$password_code')";
        
        if(mysqli_query($conn,$sql))
        {
            header("location:index.php");
            exit();
        }
        else
        {
            echo 'ERROR' . mysqli_error($conn);
        }
    }
}

function email_existe($email,$conn)
{
    $sql_verfie_emial="SELECT * FROM `medcin` WHERE medcin.email_medcin='$email' or medcin.user_name_medcin='$email'";
    if(mysqli_query($conn , $sql_verfie_emial))
    {
        $result =mysqli_query($conn,$sql_verfie_emial);
        $row =mysqli_num_rows ($result);
        if($row==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        echo 'ERROR' . mysqli_error($conn);
    }
}

function check_mdp_format($password)
    {
        $majuscule = preg_match('@[A-Z]@', $password);
        $minuscule = preg_match('@[a-z]@', $password);
        $chiffre = preg_match('@[0-9]@', $password);
        
        if(!$majuscule || !$minuscule || !$chiffre )
        {
            return false;
        }
        else  return true; 

    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-creercompte.css">
    <title>CREE COMPTE MEDECIN</title>
</head>

<body>
<div class="box2 box3">
  <div class="creer-compte">
     <h1>Créer Compte</h1>
    <form action="cree_compte_medecin.php" method="POST" >
     <div class="nom-prenom">
        <div class="form-input">
        <input class ="form__input" type="text"      name="nom"               id="nom"              
        placeholder=" "  value="<?php if (isset($_POST['submit'])){ echo  $nom ;}?>"> <br>
        <label class="form__label" for="nom">Nom:</label>
        <span><?php echo $err_nom ;?> </span> <br>
        </div>
        <div class="form-input">
        <input class="form__input" type="text"      name="prenom"            id="prenom"    
        placeholder=" "  value="<?php if (isset($_POST['submit'])){ echo  $prenom ;}?>" > <br>
        <label class="form__label" for="prenom">Prénom:</label>
        <span><?php echo $err_prenom ;?> </span><br>
        </div>
    </div>
        <div class="form-input">
        <input  class="form__input" type="text"      name="username"          id="username"  
        placeholder=" "  value="<?php if (isset($_POST['submit'])){ echo  $username;} ?>"> <br>
        <label class="form__label" for="username">Nom d'utilisatuer:</label>
        <span><?php echo $err_username ;?> </span><br>
        </div>
        <div class="form-select">
        <label for="specialite">specialite:</label> <br> <br>
        <select name="specialite" id="specialite"  onchange="javascript:submit(this);" class ="zone_de_choix">
            <option></option>
            <?php  foreach($specialites as $specialite):?>
                <option value="<?php echo $specialite['id_specialite'];?>" <?php if(isset($_POST['specialite'])){if($_POST['specialite']==$specialite['id_specialite']){echo "selected";}} ?> class="option"> 
                    <?php echo  $specialite['nom_specialite']; ?>
                </option>
            <?php endforeach;?>   
        </select> <br>
        </div>
        <div class="nom-prenom">
       <div class="form-input">
        
        <input class="form__input" type="tel"       name="telephone"   id="telephone"  
        placeholder=" "    value="<?php if (isset($_POST['submit'])){echo $telephone ;}?>"><br>
        <label class="form__label" for="username">Téléphone:</label>
        <span><?php echo $err_tel ;?> </span><br>
        </div>
        <div class="form-input">
        
        <input class ="form__input" type="email"     name="email"       id="email"      
        placeholder=" "        value="<?php if (isset($_POST['submit'])){echo $email ;}?>"><br>
        <label class="form__label" for="email">Email:</label>
        <span><?php echo $err_email ;?> </span><br>
        </div>
    </div>
     <div class="nom-prenom">
         <div class="form-input">
       
        <input class="form__input" type="password"  name="password1"  id="password1"  
        placeholder=" "  value="<?php if(isset($_POST['submit'])){echo  $password1;}?>"> <br>
        <label class="form__label" for="password1">Mot de passe:</label>
        </div>
        <div class="form-input">
        <input class="form__input" type="password"  name="password2"  id="password2"  
        placeholder=" "  value="<?php if(isset($_POST['submit'])){ echo $password2;}?>"> 
        <label class="form__label" for="password1">Confarmation</label>
        <span><?php echo $err_pass ;?> </span><br>
        </div>
    </div>
        <div class="secon">
            <p class="p-creer">Avez-vous déjà un compte  <a href="login_medcin.php">se connecter</a></p>
           
        </div>
        <button type="submit" name="submit">creer compte</button>
    </form>
    </div>
    <div class="img">
        <img src="../img/logo-of-profile.svg" alt="">
    </div>
    </div>
</body>
</html>
