<?php
/**
 * Created by PhpStorm.
 * User: diafara
 * Date: 02/06/2020
 * Time: 16:11
 */

    function addInscription($anneeAcad, $eleve, $classe)
    {
        $date = date("Y-m-d");
        $sql = "INSERT INTO inscription VALUES (NULL, '$date', $anneeAcad, '$eleve', '$classe')";
        return executeSQL($sql);
    }