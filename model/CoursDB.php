<?php

    function addCours($coef,$matiere,$prof,$classe,$an)
    {
        $sql = "INSERT INTO cours VALUES (NULL, '$coef' , '$matiere', '$prof', '$classe','$an')";
        return executeSQL($sql);
    }

    function listeCours()
    {
        $sql = "SELECT * FROM cours";
        return executeSQL($sql);
    }

    function updateCours($id,$coef,$matiere,$prof,$classe)
    {
        $sql = "UPDATE cours SET coef = '$coef',
                                  matiere = '$matiere',
                                  professeur = '$prof',
                                  classe = '$classe'
                                  WHERE idC = $id";
        return executeSQL($sql);
    }

    function deleteCours($id)
    {
        $sql = "DELETE FROM cours WHERE idC = $id";
        return executeSQL($sql);
    }

    function getCoursById($id)
    {
        $sql = "SELECT * FROM cours WHERE idC= '$id'";
        return executeSQL($sql);
    }