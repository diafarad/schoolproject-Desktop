<?php

    function addClasse($libelle,$montantIns,$mensualite)
    {
        $sql = "INSERT INTO classe VALUES (NULL, '$libelle' , '$montantIns', '$mensualite')";
        return executeSQL($sql);
    }

    function listeClasse()
    {
        $sql = "SELECT * FROM classe";
        return executeSQL($sql);
    }

    function updateClasse($id,$libelle,$montantIns,$montantMens)
    {
        $sql = "UPDATE classe SET libelle = '$libelle',
                                  montantInscription = '$montantIns',
                                  mensualite = '$montantMens'
                                  WHERE id = $id";
        return executeSQL($sql);
    }

    function deleteClasse($id)
    {
        $sql = "DELETE FROM classe WHERE id = '$id'";
        return executeSQL($sql);
    }

    function getClasseById($id)
    {
        $sql = "SELECT * FROM classe WHERE id= '$id'";
        return executeSQL($sql);
    }