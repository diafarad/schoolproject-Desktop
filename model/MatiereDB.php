<?php
/**
 * Created by PhpStorm.
 * User: diafara
 * Date: 13/06/2020
 * Time: 00:42
 */
    function addMatiere($libelle)
    {
        $sql = "INSERT INTO matiere VALUES (NULL, '$libelle')";
        return executeSQL($sql);
    }

    function listeMatiere()
    {
        $sql = "SELECT * FROM matiere";
        return executeSQL($sql);
    }

    function updateMatiere($id,$libelle)
    {
        $sql = "UPDATE matiere SET libelle = '$libelle'
                                      WHERE id = $id";
        return executeSQL($sql);
    }

    function deleteMatiere($id)
    {
        $sql = "DELETE FROM matiere WHERE id = $id";
        return executeSQL($sql);
    }

    function getMatiereById($id)
    {
        $sql = "SELECT * FROM matiere WHERE id= '$id'";
        return executeSQL($sql);
    }