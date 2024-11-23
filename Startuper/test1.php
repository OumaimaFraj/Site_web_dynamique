<?php
include '../php/connect.php';
session_start();

if (isset($_POST['acheteractionid'])) {
    //les variables
    $id_projet = $_GET['acheteractionid'];
    $nombres_actions_achetees =$_POST['nombre_actions_achetees']; 
    $id_capital_risque = $_SESSION['id_capital_risque'];
    $id_capital_risque_projet = unique_id();
    // Récupérer les données de la table projet
    $recuperer_projet = $conn->prepare("SELECT nombre_actions_a_vendre, nombre_actions_vendues FROM projet WHERE id_projet = ?");
    $recuperer_projet->execute([$id_projet]); 

     // Récupérer les résultats de la requête
    $row = $recuperer_projet->fetch(PDO::FETCH_ASSOC);

    // Extraire les valeurs récupérées
    $nombre_actions_a_vendre = $row['nombre_actions_a_vendre'];
    $nombre_actions_vendues = $row['nombre_actions_vendues'];

    // Calcul des nouvelles valeurs
    $nouveau_nombre_actions_a_vendre = $nombre_actions_a_vendre - $nombres_actions_achetees;
    $nouveau_nombre_actions_vendues = $nombre_actions_vendues + $nombres_actions_achetees;

    // Update des actions dans la table projet
    $update_actions_projet = $conn->prepare("UPDATE projet SET nombre_actions_a_vendre=?, nombre_actions_vendues=? WHERE id_projet=?");
    $update_actions_projet->execute([$nouveau_nombre_actions_a_vendre, $nouveau_nombre_actions_vendues, $id_projet]); 

    // Insertion dans la table de capital risque
    $insert_projet_cr= $conn->prepare("INSERT INTO capital_risque_projet (id_capital_risque_projet, id_projet, id_capital_risque, nombre_actions_achetees) VALUES (?, ?, ?, ?)");
    $insert_projet_cr->execute([$id_capital_risque_projet, $id_projet1, $id_capital_risque, $nombres_actions_achetees]);  

    // Vérifie si l'insertion a réussi
        if ($insert_projet_cr->rowCount() > 0){
            echo "<script>
            alert('Le projet de capital risque a été ajouté avec succès.');
            window.location.href = 'Projet_a_financer.php';
            </script>";
        exit; 
        } else {
            echo "<script>
            alert('Impossible dacheter le projet.');
            window.history.back();
            </script>";
            exit;
        }
}
?>