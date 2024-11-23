<?php
//CONNECT AND START THE SESSION
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
        </div>

    <!--------------------Afficher les projets ----------------------->  
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID-Projet</th>
                <th>Mon ID</th>
                <th>Nombre d'actions achetées</th>
            </tr>
        </thead>
        <tbody>
        <?php

        if (isset($_SESSION['id_capital_risque'])) {

            $id_capital_risque = $_SESSION['id_capital_risque'];
        $sql = "SELECT * FROM capital_risque_projet WHERE id_capital_risque = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_capital_risque]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "
            <tr>
                <td>{$row['id_capital_risque_projet']}</td>
                <td>{$row['id_projet']}</td>
                <td>{$row['id_capital_risque']}</td>
                <td>{$row['nombre_actions_achetees']}</td>
                <a class='btn btn-primary btn-sm' href='Afficher_proj.php?afficheid={$row['id_projet']}'>Afficher</a>

                
            </tr>";
        }
    }
        ?>
        </tbody>
    </table>




<!-- =========== Scripts =========  -->
<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>    
</body>
</html>