<?php
session_start();
session_unset();
session_destroy();
header("Location: ../index3/pageindex.html");
?>