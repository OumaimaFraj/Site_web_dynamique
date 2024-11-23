<!--CAPITALRISQUE SIGNUP-->
<?php
//TO CONNECT
include '../php/connect.php';


if (isset($_POST['submit'])){

    $id_capital_risque=unique_id();
    

    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $pseudo=$_POST['pseudo'];
    $email=$_POST['email'];
    $pwrd=$_POST ['pwrd'];
    $CIN=$_POST['CIN'];

   // Vérification de l'existence de l'email dans la base de données
    $select_capitalrisque = $conn->prepare("SELECT * FROM capital_risque WHERE email_cr=?");
    $select_capitalrisque->execute([$email]);

    if($select_capitalrisque->rowCount() > 0){
        // Si l'email existe déjà, afficher un message d'avertissement
        $warning_mesg[]='Email already exist';
    }
    else {
        // Sinon, insérer les données dans la base de données
        $insert_capitalrisque = $conn->prepare("INSERT INTO capital_risque (id_capital_risque, nom_capital_risque, prenom_capital_risque, email_cr,CIN_cr, pseudo_cr, pwrd_cr) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert_capitalrisque->execute([$id_capital_risque, $nom, $prenom, $email, $CIN, $pseudo, $pwrd]);
        
        if ($insert_capitalrisque->rowCount() > 0){
            $success_mesg[]='new capitalRisque registered! please log in now';
        
        }
    }

}
?>
<!--HTML STRUCTURE-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RegistrationCapitalRisque Page</title>
    <link rel="stylesheet" type="text/css" href="../css/register.css">
    <!-- Font Awesome link pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <!--CLASSE LKBIRA MTAA FORM  SHFIH-->
<div class="form-container">
    <!--class REGISTER FOR CSS-->
    <form id="form" name ="form" action="" method="post" enctype="multipart/form-data" >
        <h3>Register Now</h3>
        <!--PARENT ELEMENT : FLEX-->
        <div class="flex">
            <!--CHILD ELEMENT : COL1-->
            <div class="col">
                <!-- NAME -->
                <div class="input-field">
                    <p>Your Name<span>*</span></p>
                    <!--YOU SHOULD WRITE THE SAME NAME IN THE DB-->
                    <input type="text" name="nom" placeholder="Enter your name" maxlength="50" required class="box">
                </div>
                <!-- PSEUDO -->
                <div class="input-field">
                    <p>Your pseudo<span>*</span></p>
                    <input type="text" name="pseudo" placeholder="Enter your pseudo" maxlength="50" required class="box">
                </div>
                <!--EMAIL-->
                <div class="input-field">
                    <p>Your Email<span>*</span></p>
                    <input type="email" name="email" placeholder="Enter your email" maxlength="50" required class="box">
                </div>
            </div>
            <!--COL2-->
            <div class="col">
                <!-- LAST NAME -->
                <div class="input-field">
                    <p>Your Last name<span>*</span></p>
                    <input type="text" name="prenom" placeholder="Enter your Last name" maxlength="50" required class="box">
                </div>
                <!-- PASSWORD-->
                <div class="input-field">
                    <p>Your password<span>*</span></p>
                    <input type="password" name="pwrd" placeholder="Enter your password" maxlength="50" required class="box">
                </div>
                <!-- CIN -->
                <div class="input-field">
                    <p>Your CIN<span>*</span></p>
                    <input type="text" name="CIN" placeholder="Enter your cin" maxlength="50" required class="box">
                </div>
            </div>
        </div>
        <!--LIGNE 4-->
        <!-- En cas où vous avez déjà un compte :LOGIN NOW -->
        <p class="link">Already have an account? <a href="loginCapitalRisque.php">Login Now</a></p>
        <!--BUTTON REGISTER NOW-->
        <input type="submit" name="submit" value="Register Now" class="btn">
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
//CHECK EMAIL
function isvalidEmail(email){
    var emailReg = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))/i);
    return emailReg.test(email);
    }
//CHECK CIN
    function isValidCin(CIN) {
    if (CIN.length !== 8) {
    return false;
    }
    if (!/^\d+$/.test(CIN)) {
    return false;
    }
    return true;
    }
//CHECK NAME
    function isValidName(nom) {
    const regex = /^[a-zA-Z]+$/; 
    return regex.test(nom);
}
//CHECK PRENOM
function isValidName(prenom) {
    const regex = /^[a-zA-Z]+$/; 
    return regex.test(prenom);
}
//CHECK PSEUDO
function isValidName(pseudo) {
    const regex = /^[a-zA-Z]+$/; 
    return regex.test(pseudo);
}

//CHECK PASSWORD
function isValidPassword(pwrd) {
    const regex = /^(?=.*[a-zA-Z0-9].*[a-zA-Z0-9].*[a-zA-Z0-9].*[a-zA-Z0-9])[a-zA-Z0-9#$]{8,}$/;
    return regex.test(pwrd);
}
document.getElementById("form").addEventListener("submit",function(e){
    
    var error;

        const nomInput = document.getElementById('nom');
        const prenomInput = document.getElementById('prenom');
        const pseudoInput = document.getElementById('pseudo');
        const CINInput = document.getElementById('CIN');
        const pwrdInput = document.getElementById('pwrd');
        const emailInput = document.getElementById('email');
//NAME
    if(form.nomInput.value==="") 
    {
    error="First name is required";
    }
    else if(!isValidName(nomInput.value))
    {
    error="Please make sure you are using only alphabets";
    }
//LAST NAME
    else if(prenomInput.value==="") 
    {
    error="Last name is required";
    }
    else if(!isValidName(prenomInput.value))
    {
    error="Please make sure you are using only alphabets";
    }
//CIN
    else if(CINInput.value==="") 
    {
    error="CIN is required";
    }
    else if(isValidCin(CINInput.value)==false)
    {
    error="Please write correctly your CIN, make sure your use 8 numbers";
    }
//EMAIL
    else if(emailInput.value==="") 
    {
    error="Email is required";
    }
    else if(!isvalidEmail(emailInput.value)){
    error="Email is not correct";
    } 
//PSEUDO
    else if(pseudoInput.value==="") 
    {
    error="Pseudo is required";
    }
//PASSWORD
    else if(passwordInput.value==="") 
    {
    error="Password is required";
    }
    else if(!isValidPassword(pseudoInput.value)){
    error="Password should contain 8 lettres or chiffres and finish with # or $ ";
    } 
//EMAIL
    else if(emailInput.value==="") 
    {
    error="email adresse is required";
    }
    else if(!isvalidEmail(emailInput.value))
    {
    error="Email incorrect";
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
<!--ALERT PHP-->
<?php include '../php/alert.php'; ?>
</body>
</html>
