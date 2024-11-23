<?php
include '../php/connect.php';
if(isset($_GET['editid'])){
    $id_projet = $_GET['editid'];

    if (isset($_POST['submit'])) {
    session_start();
    $id_startuper = $_SESSION['id_startuper'];

    $titre = $_POST['title'];
    $description = $_POST['description'];
    $nombre_actions_a_vendre =  $_POST['nbacav'];
    $nombre_actions_vendues =  $_POST['nbacv'];
    $prix_action =  $_POST['prixac'];
    $id_startuper = $_SESSION['id_startuper'];

        // Update data into database

        $update_projet = $conn->prepare("UPDATE projet SET titre=?,description=?, nombre_actions_a_vendre=?,nombre_actions_vendues=?,prix_action=?,id_startuper=? WHERE id_projet=?");
        $update_projet->execute([$titre, $description, $nombre_actions_a_vendre, $nombre_actions_vendues, $prix_action, $id_startuper,$id_projet]); 
        //messages
        if ($update_projet->rowCount() > 0) {
            echo "<script>
            alert('Project updated successfully');
            window.location.href = 'Lister_Proj.php';
        </script>";
        } else {
            echo "<script>
            alert('You can't update this project');
            window.location.href = 'Lister_Proj.php';
        </script>"; }           
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleform.css">
    <link rel="stylesheet" href="styleProfil.css">
    <title>Add project</title>
</head>
<body>
    <!-------------------------------------------NAVIAGATION-------------------------------------------------->
    <div class="container">
        <div class="navigation">
            <ul>
                <!--LOGO-->
                <li>
                    <a href="#" ><img src="logo2.png" class="logo"></a>
                </li>
                <!--DASHBOARD-->
                <li>
                    <a href="ProfilStartuper.html">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <!--LISTER PROJECTS-->
                <li>
                    <a href="Lister_Proj.php">
                        <span class="icon"><ion-icon name="file-tray-stacked-outline"></ion-icon></span>
                        <span class="title">Lister mes projet</span>
                    </a>
                </li>
                <!--EDIT PROJECT-->
                <li>
                    <a href="EditProj.php">
                        <span class="icon"><ion-icon name="create-outline"></ion-icon></span>
                        <span class="title">Editer un projet</span>
                    </a>
                </li>
                <!--ADD project-->
                <li>
                    <a href="AjouterProjet.php">
                        <span class="icon"><ion-icon name="bag-add-outline"></ion-icon></span>
                        <span class="title">Ajouter un projet</span>
                    </a>
                </li>
                <!--ACTIONNAIRES-->
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                        <span class="title">Voir les actionnaires</span>
                    </a>
                </li>
                <!--EDIT PROFILE-->
                <li>
                    <a href="EditProfilS.php">
                        <span class="icon"><ion-icon name="create-outline"></ion-icon></span>
                        <span class="title">Edit Profile</span>
                    </a>
                </li>
                <!--SETTINGS-->
                <li>
                    <a href="#">
                        <span class="icon"><ion-icon name="settings-outline"></ion-icon></span>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <!--SIGN OUT-->
                <li>
                    <a href="logout.php">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- ========================= Main ==================== -->
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>

            <div class="search">
                <label>
                    <input type="text" placeholder="Search here">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>

            <div class="user">
                <img src="user.png" alt="">
            </div>
        </div>


    <!--------------------FORM AJOUTER UN PROJET ----------------------->  
    <section> <div class="form-box"> <div class="form-value">
    <form id ="form" name="form"  method="POST" action="">

        <fieldset>
        <legend>Titre </legend>
        <label>Titre du projet</label>
        <input id="title" name="title" type="text">
        </fieldset>

        <br></br>

        <fieldset>  
        <legend> Description </legend>
        <label>Description </label>
        <textarea id="description" name="description" type="text"> </textarea></fieldset>
        <br></br>

        <fieldset>
            <legend> Nombre d'actions à vendre </legend>
            <input type="number" name="nbacav" required>
        </fieldset>

        <br></br>
        <fieldset>
            <legend> Nombre d'actions vendues </legend>
            <input type="number" name="nbacv" required>
        </fieldset>

        <br></br>

        <fieldset>
            <legend>Prix d'action en Dinar</legend>
            <input type="number" name="prixac" required>
        </fieldset>

        <br></br>
        <button type="submit" name="submit" id="submit">Update</button>


    </form>
    <p style="color:red;" id="error"></p>
<!--CONTROLE DE SAISIE-->


<!-- =========== Scripts =========  -->
<script>
 // add hovered class to selected list item
let list = document.querySelectorAll(".navigation li");

function activeLink() {
    list.forEach((item) => {
    item.classList.remove("hovered");
    });
    this.classList.add("hovered");
}

list.forEach((item) => item.addEventListener("mouseover", activeLink));

  // Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation");
let main = document.querySelector(".main");

toggle.onclick = function () {
navigation.classList.toggle("active");
main.classList.toggle("active");
};
</script>
<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>    

</body>
</html>