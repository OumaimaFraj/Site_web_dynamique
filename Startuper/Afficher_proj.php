<?php
include '../php/connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleProfil.css">
    <!--lien bootsrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Lister les projets</title>
</head>
<body>
    <!-------------------------------------------NAVIAGATION-------------------------------------------------->
        <div class="navigation">
            <ul>
                <!--LOGO-->
                <li>
                    <a href="#" ><img src="logo2.png" class="logo"></a>
                </li>
                <!--DASHBOARD-->
                <li>
                    <a href="ProfilCapitalRisque.html">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <!--LISTER PROJECTS-->
                <li>
                    <a href="Projet_a_financer.php">
                        <span class="icon"><ion-icon name="file-tray-stacked-outline"></ion-icon></span>
                        <span class="title">Les projets a financer</span>
                    </a>
                </li>
                <!--EDIT PROJECT-->
                <li>
                        <a href="Afficher_proj.php">
                            <span class="icon"><ion-icon name="create-outline"></ion-icon></span>
                            <span class="title">Afficher projet </span>
                        </a>
                </li>
                <!--LISTER PROJECTS-->
                <li>
                        <a href="Lister_proj_cr.php">
                            <span class="icon"><ion-icon name="file-tray-stacked-outline"></ion-icon></span>
                            <span class="title">Lister mes projet</span>
                        </a>
                    </li>
                <!--EDIT PROFILE-->
                <li>
                    <a href="#">
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
    

    <!--------------------Afficher le projet concerné ----------------------->  
        <?php
        if(isset($_GET['afficheid'])){

        $id_projet = $_GET['afficheid'];
            
        $sql = "SELECT * FROM projet WHERE id_projet = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_projet]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "
            <div class='box'>
            <div class='column'>ID Projet: {$row['id_projet']}</div>
            <div class='column'>Titre: {$row['titre']}</div>
            <div class='column'>Description: {$row['description']}</div>
            <div class='column'>Nombre d'actions à vendre: {$row['nombre_actions_a_vendre']}</div>
            <div class='column'>Nombre d'actions vendues: {$row['nombre_actions_vendues']}</div>
            <div class='column'>Prix de l'action: {$row['prix_action']}</div>
            <div class='column'>ID Startuper: {$row['id_startuper']}</div>
        </div>";
        }
        
    }
    ?>
    
<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>    
</body>
</html>