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
    <link rel="stylesheet" href="styleform.css">
    <!--lien bootsrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Lister les projets</title>
</head>
<body>
    <!-- ========================= Main ==================== -->
    <style>
        body {
            background-image: url('Bleu.png');
            background-size: cover; /* Ajuste la taille de l'image pour couvrir l'ensemble de la fenêtre */
            background-position: center; /
        }
    </style>

    <!--------------------Acheter des actions de projet concerné ----------------------->  
    <?php
        if(isset($_GET['acheterid'])){

            $id_projet = $_GET['acheterid'];
            $recuperer_nombres_a_vendre  = $conn->prepare("SELECT nombre_actions_a_vendre FROM projet WHERE id_projet = ?");
            $recuperer_nombres_a_vendre->execute([$id_projet]); 
        
             // Récupérer les résultats de la requête
            $res = $recuperer_nombres_a_vendre->fetch(PDO::FETCH_ASSOC);
        
            // Extraire la valeur récupérées
            $nombre_actions_a_vendre = $res['nombre_actions_a_vendre'];
            
            echo "
            <div class='box'>
            <form action='Afficher_proj.php' method='POST'> 
                <label for='nombre_actions_achetees'>Nombre d'actions a acheter:</label>
                <input type='number' id='nombre_actions_achetees' method='POST' name='nombre_actions_achetees'>
                <div class='button-container' style='margin-top: 15px;'>
                <a class='btn btn-primary btn-sm' href='test1.php?acheteractionid=$id_projet' onclick='checkValue($nombre_actions_a_vendre)'>Acheter</a>
    
                </div>
            </form>
            </div>";
        
        
    }
    ?>
    
    <!--CONTROLE DE SAISIE-->
    <script>
    function checkValue(maxValue) {
    var inputValue = document.getElementById('nombre_actions').value;
    if (parseInt(inputValue) > parseInt(maxValue)) {
        document.getElementById('errorMessage');
        return false;
    }
    return true;
}
</script>
<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>    
</body>
</html>