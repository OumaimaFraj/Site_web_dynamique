<!--STARTUPER LOGIN-->
<?php
//TO CONNECT
include '../php/connect.php';

if (isset($_POST['submit'])) {
    $pseudo = $_POST['pseudo'];
    $pwrd = $_POST['pwrd'];

    // Vérification de l'existence de l'email dans la base de données
    $select_startuper = $conn->prepare("SELECT * FROM startuper WHERE pseudo=? AND pwrd=?");
    $select_startuper->execute([$pseudo, $pwrd]);

    // Vérifier si le startuper existe
    if ($select_startuper->rowCount() > 0) {
        session_start(); // Démarrage de la session
        $row = $select_startuper->fetch(PDO::FETCH_ASSOC);
        //STORE ID IN SESSION
        $_SESSION['id_startuper'] = $row['id_startuper'];
        header('location: ProfilStartuper.html');
        exit();
    } else {
        $warning_mesg[] = 'incorrect pseudo or password';
    }
}

?>

<!--HTML STRUCTURE-->
<!--son pseudo et son mot de passe-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LoginStartuper Page</title>
    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <!-- Font Awesome link pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <!--CLASSE LKBIRA MTAA FORM  SHFIH-->
<div class="form-container">
    <!--class REGISTER FOR CSS-->
    <form id="form" name ="form" action="" method="post" enctype="multipart/form-data" >
        <h3>Login Now</h3>
        <!--PARENT ELEMENT : FLEX-->
        <div class="flex">
            <!--CHILD ELEMENT : COL1-->
            <div class="col">
                <!-- PSEUDO -->
                <div class="input-field">
                    <p>Your pseudo<span>*</span></p>
                    <input type="text" name="pseudo" placeholder="Enter your pseudo" maxlength="50" required class="box">
                </div>
                <!-- PASSWORD-->
                <div class="input-field">
                    <p>Your password<span>*</span></p>
                    <input type="password" name="pwrd" placeholder="Enter your password" maxlength="50" required class="box">
                </div>
            </div>
        </div>
        <p class="link">Do not have an account ? <a href="registerStartuper.php">Register Now</a></p>
        <!--BUTTON LOGIN NOW-->
        <input type="submit" name="submit" value="Login Now" class="btn">
    </form>
</div>

<!-- SweetAlert link : SweetAlert est une bibliothèque JavaScript qui permet de créer des boîtes de dialogue personnalisées -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<!-- Custom JS link -->
<script src="../js/script.js"></script>
<!--LES CONTOLES DE SAISIES b JS-->
<p style="color:red;" id="error"></p>
<p style="color:red;" id="email-error"></p>
<script>
//CHECK PSEUDO
function isValidName(pseudo) {
    const regex = /^[a-zA-Z]+$/; 
    return regex.test(pseudo);
}
//CHECK PASSWORD
function isValidPassword(password) {
    const regex = /^(?=.*[a-zA-Z0-9].*[a-zA-Z0-9].*[a-zA-Z0-9].*[a-zA-Z0-9])[a-zA-Z0-9#$]{8,}$/;
    return regex.test(password);
}
document.getElementById("form").addEventListener("submit",function(e){
    
    var error;

    const form = document.getElementById('form');
        const pseudoInput = document.getElementById('pseudo');
        const pwrdInput = document.getElementById('pwrd');
//PSEUDO
    if(form.pseudoInput.value==="") 
    {
    error="Pseudo is required";
    }
//PASSWORD
    else if(form.passwordInput.value==="") 
    {
    error="Password is required";
    }
    else if(!isValidPassword(form.pseudoInput.value)){
    error="Password should contain 8 lettres or chiffres and finish with # or $ ";
    } 
    
    if (error)
    {
    e.preventDefault();
    alert(error);
    // document.getElementById("error").innerHTML=error;
    return false;
    }
    else
   //  alert("SUCCESSFUL");
document.getElementById("form").submit();
});

</script>

</script>

<?php include '../php/alert.php'; ?>
</body>
</html>