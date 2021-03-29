<?php

require_once '../model/DB.php';
require_once '../model/MatiereDB.php';


    $ok = 0;
    if(isset($_POST['validerm'])){
        $lib = $_POST['libm'];

        $ok = addMatiere($lib);
        header("location:../../view/matiere/index.php?resultA=$ok");
    }

    if(isset($_POST['enregistrerm']))
    {
        $ok = updateMatiere($_POST['matiere_id'],$_POST['libellem']);
        header("location:../../view/matiere/index.php?resultE=$ok");
    }

    if(isset($_POST['supprimerm']))
    {
        $ok = deleteMatiere($_POST['idm_del']);
        header("location:../../view/matiere/index.php?resultS=$ok");
    }
