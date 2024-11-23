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

            <div class="user">
                <img src="user.png" alt="">
            </div>
        </div>

    <!--------------------Afficher les projets ----------------------->  
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre de projet</th>
                <th>Description</th>
                <th>Nombre d'actions à vendre</th>
                <th>Nombre d'actions vendues</th>
                <th>Prix d'action</th>
                <th>ID startuper</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php

        if (isset($_SESSION['id_startuper'])) {
        // Récupère l'ID du startuper depuis la session
        $id_startuper = $_SESSION['id_startuper'];
        $sql = "SELECT * FROM projet WHERE id_startuper = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_startuper]);
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "
            <tr>
                <td>{$row['id_projet']}</td>
                <td>{$row['titre']}</td>
                <td>{$row['description']}</td>
                <td>{$row['nombre_actions_a_vendre']}</td>
                <td>{$row['nombre_actions_vendues']}</td>
                <td>{$row['prix_action']}</td>
                <td>{$row['id_startuper']}</td>
                <td>
                    <a class='btn btn-primary btn-sm' href='EditProj.php?editid={$row['id_projet']}'>Edit</a>
                    <a class='btn btn-danger btn-sm' href='DeleteProj.php?deleteid={$row['id_projet']}'>Delete</a>
                    </td>
            </tr>";
        }
    }
        ?>
        </tbody>
    </table>




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