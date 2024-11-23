<?php
if (isset($success_mesg)){
    foreach($success_mesg as $success_mesg){
        echo'<script>swal("'.$success_mesg.'","","sucess");</script>';
    }
}

if (isset($warning_mesg)){
    foreach($warning_mesg as $warning_mesg){
        echo'<script>swal("'.$warning_mesg.'","","warning");</script>';
    }
}

if (isset($error_mesg)){
    foreach($error_mesg as $error_mesg){
        echo'<script>swal("'.$error_mesg.'","","error");</script>';
    }
}
    

?>