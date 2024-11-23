<?php
include '../php/connect.php';

if(isset($_GET['deleteid'])){
    $id_projet = $_GET['deleteid'];

    $sql = "DELETE FROM projet WHERE id_projet=? AND nombre_actions_vendues=0";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id_projet]);

    if($stmt->rowCount() > 0){
        echo "<script>
        alert('Project deleted successfully');
        window.location.href = 'Lister_Proj.php';
    </script>";
        exit; 
    }
else {
        echo"<script>
        alert('Vous ne pouvez pas supprimer un projet qui a déjà des actions vendues !!');
        window.history.back();
    </script>";
    }
}
?>

