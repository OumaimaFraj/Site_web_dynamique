<!--STARTUPER LOGIN-->
<?php
//TO CONNECT
include '../php/connect.php';

if (isset($_POST['submit'])) {
    session_start();
    $id_startuper = $_SESSION['id_startuper'];
    $Newpseudo = $_POST['pseudo'];
    $Newpwrd = $_POST['pwrd'];

//update profil
    $update_startuper = $conn->prepare("UPDATE startuper SET  pseudo=?, pwrd=? WHERE id_startuper=?");
    $update_startuper->execute([$Newpseudo, $Newpwrd,$id_startuper,]);

    //messages
    if ($update_startuper->rowCount() > 0) {
        echo "<script>
        alert('Profil updated successfully');
        window.location.href = 'loginStartuper.php';
    </script>";
    } else {
        echo "<script>
        alert('You cant update your profile');
        window.location.href = 'ProfilStartuper.html';
    </script>"; }   
}

?>

<!--HTML STRUCTURE-->
<!------------------------------------------NEW PSEUDO OR NEW PWRD------------------------------>
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
                    <p>Your New pseudo<span>*</span></p>
                    <input type="text" name="pseudo" placeholder="Enter your new pseudo" maxlength="50" required class="box">
                </div>
                <!-- PASSWORD-->
                <div class="input-field">
                    <p>New password<span>*</span></p>
                    <input type="password" name="pwrd" placeholder="Enter your new password" maxlength="50" required class="box">
                </div>
                <!-- VERIFY YOUR PASSWORD-->
                <div class="input-field">
                    <p>Verified password<span>*</span></p>
                    <input type="password" name="pwrd" placeholder="Verify your passwoard" maxlength="50" required class="box">
                </div>
            </div>
        </div>
        
        <!--BUTTON LOGIN NOW-->
        <input type="submit" name="submit" value="Edit" class="btn">
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
    else if(form.pwrdInput.value==="") 
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