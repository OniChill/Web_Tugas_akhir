<!DOCTYPE html>
<html lang="en">
<head>
    <?php

        include "SessionKemahasiswaan.php";
        $id = trim( $_GET['id']);

?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

<?php include '../template/head.php' ?>


</head>
  


<body id="page-top">

<embed type="application/pdf" src="../ormawa/<?= $id ?>" width="1920" height="1080"></embed>

</body>

</html>
